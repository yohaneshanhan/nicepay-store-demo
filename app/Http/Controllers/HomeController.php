<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// import file model Person
use App\Model\Trans;

class HomeController extends Controller
{
    
    public function home(){

        // return view('layouts/index');
        return view('layouts.vue');
    }

    public function getData(){
        return Trans::all();
    }

    public function getDetail($id)
    {
        return Trans::find($id);
    }

    public function update($id, Request $request)
    {
        $trans = Trans::find($id);
        $trans->update($request->all());
        return $trans;
    }

    

}
