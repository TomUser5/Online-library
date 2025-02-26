<?php

namespace App\Http\Controllers;

use App\Models\Exercise_Material;
use App\Models\PasswordResetToken;
use App\Models\Read_Material;
use App\Models\School_class;
use App\Models\Author;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        //$role = session('role');
        //return view('index', compact('role'));
        return view('index');
    }

    public function books(Request $request)
    {
        $query = Read_Material::with(['author', 'subject', 'class']);
    
        if ($request->has('authors')) {
            $query->whereIn('author_id', $request->authors);
        }
    
        if ($request->has('subjects')) {
            $query->whereIn('subject_id', $request->subjects);
        }
    
        if ($request->has('classes')) {
            $query->whereIn('class_id', $request->classes);
        }
    
        $books = $query->get();
    
        $authors = Author::all();
        $subjects = Subject::all();
        $classes = School_class::all();
    
        return view('books', compact('books', 'authors', 'subjects', 'classes'));
    }    

    public function viewRecentlyAdded()
    {
        $materials = Exercise_Material::orderBy('created_at', 'desc')->get();
        $books = Read_Material::orderBy('created_at', 'desc')->get();

        foreach ($materials as $material) {
            $material->timeDifference = $material->created_at->diffForHumans();
        }

        foreach ($books as $book) {
            $book->timeDifference = $book->created_at->diffForHumans();
        }

        return view('recentlyAdded', compact('materials', 'books'));
    }
}
