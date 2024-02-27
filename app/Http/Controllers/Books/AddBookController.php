<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\Exercise_Material;
use App\Models\Read_Material;
use App\Models\School_class;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Type_Material;
use Illuminate\Support\Facades\Auth;

class AddBookController extends Controller
{
    public function viewAddBook()
    {
        $type_materials = Type_Material::all();
        $subjects = Subject::all();
        $classes = School_class::all();
        $authors = Author::all();
        return view('addBook', compact('type_materials', 'subjects', 'classes', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'type_material_id' => 'required',
                'subject_id' => 'required',
                'class_id' => 'required',
                'author_id' => 'required',
                'document' => 'required|mimes:doc,docx,xls,xlsx,ppt,pptx,pdf|max:8119',
            ],
            [
                'title.required' => 'Полето е задължително да се попълни!',
                'type_material_id.required' => 'Полето е задължително да се попълни!',
                'subject_id.required' => 'Задължително е да се избере опция!',
                'class_id.required' => 'Задължително е да се избере опция!',
                'author_id.required' => 'Задължително е да се избере опция!',
                'document.required' => 'Документът е задължителен!',
                'document.mimes' => 'Моля, изберете документ в поддържан формат: .doc, .docx, .xls, .xlsx, .ppt, .pptx',
                'document.max' => 'Документът трябва да бъде под 8 MB',
            ]
        );
        
        $file = $request->file('document');

        $loc = 'books_save/'.$file->getClientOriginalName();
        $user = Auth::user()->id;
        $id = Teacher::where('user_id', $user)->first()->id;

        $herb = new Read_Material();
        $herb->fill([
            'title' => $request['title'],
            'location' => $loc,
            'type_material_id' => $request->input('type_material_id'),
            'subject_id' =>$request->input('subject_id'),
            'class_id' => $request->input('class_id'),
            'author_id' => $request->input('author_id'),
            'teacher_id' => $id,
        ]);

        $file = $request->file('document');

        $directory = 'books_save/';
        $file->move($directory, $file->getClientOriginalName());

        $herb->save();

        session()->flash('success', 'Книгата е успешно добавена!');
        return redirect()->route('index');
    }
}