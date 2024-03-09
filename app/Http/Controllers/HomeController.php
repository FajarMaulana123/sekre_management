<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        $data['mitra'] = DB::table('mitra')->where('deleted', '!=', 1)->get();
        $data['team'] = DB::table('team')->where('deleted', '!=', 1)->get();
        $data['testimoni'] = DB::table('testimoni')->where('deleted', '!=', 1)->get();
        $data['profile'] = getProfile();
        return view('frontend.home', compact('data'));
    }
}
