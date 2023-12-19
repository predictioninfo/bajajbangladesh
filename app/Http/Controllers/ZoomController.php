<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZoomController extends Controller
{
    public function index()
    {
        return view('back-end.zoom.index');
    }
    
   public function editorsChoice()
    {
        return view('editor');
    }
   public function editor()
    {
        return view('editor');
    }
}
