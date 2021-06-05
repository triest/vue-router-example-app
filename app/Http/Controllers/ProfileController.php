<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    public function index()
    {
        //
        $user=Auth::user();
        return new ProfileResource($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(ProfileRequest $request)
    {
        //
        $user=Auth::user();
        $user->name=$request->name;
        if($request->password){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return new ProfileResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        //


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadMainPhoto(PhotoRequest $request){

        $imageName = time().'.'.$request->file->extension();

        $user=Auth::user();



        if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('profile', $fileName, 'public');
            $name = time().'_'.$request->file->getClientOriginalName();
            $path = '/storage/' . $filePath;
            $user->photo_name=$name;
            $user->photo_url=$filePath;
            $user->save();
            return response()->json(['result'=>true]);
        }

        return response()->json(['result'=>true]);
    }

}
