<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnketResource;
use App\Models\User;
use Illuminate\Http\Request;

class AnketController extends Controller
{
    //
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($unique_id)
    {
        $user=User::select(['*'])->where('unique_id',$unique_id)->first();
        return new AnketResource($user);
    }
}
