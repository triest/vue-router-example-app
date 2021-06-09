<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnketController extends Controller
{
    //
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($unique_id)
    {
        //
        dump($unique_id);

    }
}
