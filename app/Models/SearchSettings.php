<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class SearchSettings extends Model
{
    //
    //
    protected $table = "search_settings";

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function target()
    {
        return $this->belongsToMany(Target::class, 'search_target',
                                    'search_id', 'target_id');
    }


    public static function getSearchSettings()
    {
        $cookie = null;
        $userAuth = Auth::user();
        if ($userAuth != null) {
            $user = User::select(['id', 'name'])
                    ->where('id', $userAuth->id)->first();

            //сли не авторизован, то смотрим по кукам.
            if ($user != null) {


                $seachSettings = $user->seachsettings()->first();

                if ($seachSettings != null) {
                    return $seachSettings;
                } else {
                    $seachSettings = new SearchSettings();
                    $seachSettings->save();
                    $user->seachsettings()->save($seachSettings);

                    return $seachSettings;
                    //   $anket->target()->attach($searchSettings);
                }
            } else {
                if (!isset($_COOKIE["searchSettings"])) {
                    $_COOKIE["searchSettings"] = Str::random(64);
                }
                $cookie = $_COOKIE["searchSettings"];
                $seachSettings = SearchSettings::select(['*'])
                        ->where("cookie", "=", $cookie)
                        ->orderBy('created_at', 'desc')
                        ->first();
                if ($seachSettings != null) {
                    return $seachSettings;
                }
            }
        } else {


            if (isset($_COOKIE["searchSettings"])
                    && $_COOKIE["searchSettings"] != null
            ) {
                $seachSettings = SearchSettings::select([
                                                                '*'
                                                        ])
                        ->orderBy('created_at', 'desc')
                        ->where("cookie", "=", $_COOKIE["searchSettings"])->first();

                if ($seachSettings == null) {

                    $seachSettings = new SearchSettings();
                    $seachSettings->cookie = $_COOKIE["searchSettings"];
                    $seachSettings->save();

                    return $seachSettings;
                }

                return $seachSettings;
            } else {

                $cookie =  Str::random(64);
                $seachSettings = new SearchSettings();
                $seachSettings->cookie = $cookie;
                $seachSettings->save();
                Cookie::queue("searchSettings", $cookie, 6000);

                return $seachSettings;
            }
        }

        return null;
    }
}
