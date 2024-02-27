<?php

namespace App\Http\Controllers\TypeFile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class viewTypeFile extends Controller
{
    public function view() 
    {
        return view('addTypeFile');
    }
}
