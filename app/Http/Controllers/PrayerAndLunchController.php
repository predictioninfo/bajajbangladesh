<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrayerAndLunchController extends Controller
{
    public function index()
    {
        return view('back-end.user.index');
    }
}
