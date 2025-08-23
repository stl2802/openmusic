<?php

namespace App\Http\Controllers;

use App\Models\Bb;
use Illuminate\Http\Request;

class BbsController extends Controller
{
    public function index(){
        $bbs = Bb::all();
        return view('index',compact('bbs'));
    }
    public function show(Bb $bb){
        return view('show',compact('bb'));
    }
}
