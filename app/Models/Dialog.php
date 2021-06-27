<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    use HasFactory;


    public function owner(){
        return $this->hasOne(User::class,'id','my_id');
    }

    public function other(){
        return $this->hasOne(User::class,'id','other_id');
    }
}
