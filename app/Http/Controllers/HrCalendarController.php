<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HrCalendarController extends Controller
{
    public function index()
    {
        return view('back-end.user.index');
    }
}
