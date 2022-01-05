<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        //$ip = $_SERVER['REMOTE_ADDR'];
        $market = DB::table('markets')->count();
        $stall = DB::table('stalls')->count();
        $post = DB::table('posts')->count();
        $gallery = DB::table('galleries')->count();
        return view('dashboard.index', compact('market', 'stall', 'post', 'gallery'));
        //dd($ip);
    }
}
