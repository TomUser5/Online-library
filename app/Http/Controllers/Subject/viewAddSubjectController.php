<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class viewAddSubjectController extends Controller
{
    public function view() 
    {
        return view('addSubject');
    }
}
