<?php

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'relation_id',
        'description',
        'children_id',
        'alcohol_id',
        'smoking_id',
        'body_type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function settings(){
        return $this->hasOne(Setting::class);
    }

    public function relation(){
        return $this->belongsTo(Relations::class);
    }

    public function target()
    {
        return $this->belongsToMany(Target::class, 'user_target')->withTimestamps();
    }

    public function interest()
    {
        return $this->belongsToMany(Interest::class,'user_interest')->withTimestamps();
    }

    public function sex(){
        return $this->belongsTo(Sex::class);
    }

    public function alcohol(){
        return $this->belongsTo(Alcohole::class);
    }

    public function bodyType(){
        return $this->belongsTo(BodyType::class);
    }

    public function children(){
        return $this->belongsTo(Children::class);
    }

    public function smoking(){
        return $this->belongsTo(Smoking::class);
    }



    public function seachsettings()
    {
        return $this->hasOne(SearchSettings::class);
    }

    public function iIgnore()
    {
        return $this->belongsToMany(User::class,'users_relations','id','who_id',);
    }
    public function meIgnore()
    {
        return $this->belongsToMany(User::class,'users_relations','target_id','id',);
    }

    public function dialog(){
        return $this->hasMany(Dialog::class,'my_id','id');
    }

    public function sendMessage($text, $who_user = null)
    {
        $TargetUser = $this;


        if ($who_user == null) {
            $user = Auth::user();
        }

        if ($user == null || $TargetUser == null) {
            return false;
        }

        $message = new Message();
        $message->to = $user->id;
        $message->from = $TargetUser->id;
        $message->text = $text;
        $message->save();

        $id2 = $TargetUser->id;
        $dialog = Dialog::select(['id', 'my_id', 'other_id'])
                ->where('my_id', $user->id)->where(
                        'other_id',
                        $id2
                )->first();
        if ($dialog == null) {
            $dialog3 = new Dialog();
            $dialog3->my_id = $user->id;
            $dialog3->other_id = $id2;
            $dialog3->lastMessage = Carbon::now();
            $dialog3->save();
        } else {
            $dialog->lastMessage = Carbon::now();
            $dialog->save();
        }
        $dialog2 = Dialog::select(['id', 'my_id', 'other_id'])
                ->where('other_id', $user->id)->where(
                        'my_id',
                        $id2
                )->first();
        if ($dialog2 == null) {
            $dialog4 = new Dialog();
            $dialog4->other_id = $user->id;
            $dialog4->my_id = $id2;
            $dialog4->lastMessage = Carbon::now();
            $dialog4->save();
        } else {
            $dialog2->lastMessage = Carbon::now();
            $dialog2->save();
        }

        if($this->isOnline()) {
          //  broadcast(new NewMessage($message));
        }else{
            $on = Carbon::now()->addMinutes($this->delayNotificationMinutes); // отправим через 10 минут
         //   dispatch(new SendNotification($message))->delay(1);
        }

        return $message;
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
}
