<?php

namespace App\Http\Controllers\AddUser;

use App\Http\Controllers\Controller;
use App\Models\School_class;
use App\Models\Subject;
use Illuminate\Http\Request;

class viewAddUser extends Controller
{
    public function view() 
    {
        $classes = School_class::all();
        $subjects = Subject::all();
        return view('addUser', compact('classes', 'subjects'));
    }

    public function viewImportUser() 
    {
        return view('importUsers');
    }
}
