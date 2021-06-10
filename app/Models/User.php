<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'relation_id',
        'description'
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
        return $this->belongsToMany(
                Interest::class
        );
    }

    public function sex(){
        return $this->hasOne(Sex::class);
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


}
