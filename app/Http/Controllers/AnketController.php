<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnketResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user=User::select(['*'])->where('unique_id',$unique_id)->with('relation','target')->first();
   //     $user=User::select(['*'])->where('unique_id',$unique_id)->first();

        $authUser=Auth::user();



        return new AnketResource($user);
    }
}
