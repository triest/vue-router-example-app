<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Target;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    public function index()
    {
        //
        $user=Auth::user();
        $user=User::select(['*'])->with('target')->where('id',$user->id)->first();


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
       // $user->name=$request->name;
        if($request->password){
            $user->password = Hash::make($request->password);
        }

        $user->fill($request->toArray());
        $user->save();

        $user->target()->detach();
        if ($request->has('target_id')) {
            foreach ($request->target_id as $item) {
                $target = Target::select(['id', 'name'])->where('id', $item)
                        ->first();
                if ($target != null) {
                    $user->target()->attach($target);
                }
            }
        }

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
            /*
             * удаляем старый файл
             * */
            if($user->photo_url!=null &&  Storage::disk('public')->exists($user->photo_url)) {
                Storage::disk('public')->delete($user->photo_url);
            }

            $fileName = time().'_'.$user->id.'_.'.$request->file->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('profile', $fileName, 'public');
            $name = time().'_'.$user->id.'_'.rand(0,100).'_.'.$request->file->getClientOriginalExtension();

            $user->photo_name=$name;
            $user->photo_url=$filePath;
            $user->save();
            return response()->json(['photo_url'=>$filePath]);
        }

        return response()->json(['result'=>true]);
    }

}
