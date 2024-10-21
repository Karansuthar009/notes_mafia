<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Uploadfile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $data = Uploadfile::with('subjects','colleges','courses')->get();
        // dd($data);
        $topFiles = Uploadfile::orderBy('view', 'desc')->take(4)->get();
        $files = Favorite::all();
        return view('layout.app',compact('data','topFiles','files'));
    }

}
