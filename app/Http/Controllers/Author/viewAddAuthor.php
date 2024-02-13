<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class viewAddAuthor extends Controller
{
    public function view() 
    {
        return view('addAuthor');
    }
}
