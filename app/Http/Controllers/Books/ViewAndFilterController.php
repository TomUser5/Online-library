<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Read_Material;
use App\Models\School_class;
use App\Models\Author;
use App\Models\Subject;


class ViewAndFilterController extends Controller
{

    public function filter(Request $request)
    {
        $books = Read_Material::with(['author', 'subject', 'class']);
    
        // Filter by authors if selected
        if ($request->has('authors')) {
            $books = $books->whereIn('author_id', $request->authors);
        }
    
        dd($request->subjects);
        if ($request->has('subjects')) {
            $subjectIds = Subject::whereIn('subject', $request->subjects)->pluck('id');
            $books = $books->whereIn('subject_id', $subjectIds);
        }
    
        // Filter by classes if selected
        if ($request->has('classes')) {
            $classIds = array_map(function ($class) {
                return json_decode($class, true)['id'];  // Decode the JSON string and extract the 'id'
            }, $request->classes);
            $books = $books->whereIn('class_id', $classIds);
        }
    
        // Get the filtered books
        $books = $books->get();
    
        // Fetch filter options from the database
        $authors = Author::all();
        $subjects = Subject::all();
        $classes = School_class::all();
    
        return view('books', compact('books', 'authors', 'subjects', 'classes'));
    }
    
    
    

}
