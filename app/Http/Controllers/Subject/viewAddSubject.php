<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class viewAddSubject extends Controller
{
    public function view() 
    {
        return view('addSubject');
    }
}
