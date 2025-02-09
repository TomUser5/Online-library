<?php

namespace App\Http\Controllers\Materials;

use App\Http\Controllers\Controller;
use App\Models\Exercise_Material;
use App\Models\School_class;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Type_Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddMaterialController extends Controller
{

    public function viewAddMaterial()
    {
        $type_materials = Type_Material::all();
        $subjects = Subject::all();
        $classes = School_class::all();
        return view('addMaterial', compact('type_materials', 'subjects', 'classes'));
    }

    public function store(Request $request)
    {
        $typeMaterial = Type_Material::where('id', $request->input('type_material_id'))->first();

        $isLink = $typeMaterial && $typeMaterial->type_material == "Линк";
        
        if($isLink)
        {
            $request->validate(
                [
                    'title' => 'required',
                    'type_material_id' => 'required',
                    'subject_id' => 'required',
                    'class_id' => 'required',
                    'link' => 'required',
                ],
                [
                    'title.required' => 'Полето е задължително да се попълни!',
                    'type_material_id.required' => 'Задължително е да се избере опция!',
                    'subject_id.required' => 'Задължително е да се избере опция!',
                    'class_id.required' => 'Задължително е да се избере опция!',
                    'link.required' => 'Полето е задължително да се попълни!',
                ]
            );
    
            $user = Auth::user()->id;
            $id = Teacher::where('user_id', $user)->first()->id;
    
            $material = new Exercise_Material();
            $material->fill([
                'title' => $request['title'],
                'location' => $request['link'],
                'type_material_id' => $request->input('type_material_id'),
                'subject_id' =>$request->input('subject_id'),
                'class_id' => $request->input('class_id'),
                'teacher_id' => $id,
            ]);
    
            $material->save();
    
            session()->flash('success', 'Материала е успешно добавен!');
            return redirect()->route('index');
        }
        else
        {
            $request->validate(
                [
                    'title' => 'required',
                    'type_material_id' => 'required',
                    'subject_id' => 'required',
                    'class_id' => 'required',
                    'document' => 'required|max:8119',
                ],
                [
                    'title.required' => 'Полето е задължително да се попълни!',
                    'type_material_id.required' => 'Полето е задължително да се попълни!',
                    'subject_id.required' => 'Задължително е да се избере опция!',
                    'class_id.required' => 'Задължително е да се избере опция!',
                    'document.required' => 'Документът е задължителен!',
                    'document.max' => 'Документът трябва да бъде под 8 MB',
                ]
            );
            
            $file = $request->file('document');
    
            $loc = 'documents/'.$file->getClientOriginalName();
            $user = Auth::user()->id;
            $id = Teacher::where('user_id', $user)->first()->id;

            $fileType = substr(strrchr( $file->getClientOriginalName(), '.'), 1);
            $type_file = Type_Material::where('type_material', $fileType)->first()->id;
    
            $herb = new Exercise_Material();
            $herb->fill([
                'title' => $request['title'],
                'location' => $loc,
                'type_material_id' => $type_file,
                'subject_id' =>$request->input('subject_id'),
                'class_id' => $request->input('class_id'),
                'teacher_id' => $id,
            ]);
    
            $file = $request->file('document');
    
            $directory = 'documents/';
            $file->move($directory, $file->getClientOriginalName());
    
            $herb->save();
    
            session()->flash('success', 'Материала е успешно добавен!');
            return redirect()->route('index');
        }
    }
}
