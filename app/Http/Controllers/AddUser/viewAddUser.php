<?php

namespace App\Http\Controllers\AddUser;

use App\Http\Controllers\Controller;
use App\Models\School_class;
use Illuminate\Http\Request;

class viewAddUser extends Controller
{
    public function view() 
    {
        $classes = School_class::all();
        return view('addUser', compact('classes'));
    }
}
