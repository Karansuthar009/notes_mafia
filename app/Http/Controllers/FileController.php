<?php

namespace App\Http\Controllers;

use App\Models\Uploadfile;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function old_paper()
    {
        $data = Uploadfile::all();
        return view('oldpaper',compact('data'));
    }
    public function notes()
    {
        $data = Uploadfile::all();
        return view('notes',compact('data'));
    }
    public function allpdf()
    {
        $data = Uploadfile::all();
        return view('allpdf',compact('data'));
    }
}
