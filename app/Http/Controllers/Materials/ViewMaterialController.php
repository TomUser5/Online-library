<?php

namespace App\Http\Controllers\Materials;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Exercise_Material;
use App\Models\School_class;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Type_Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ViewMaterialController extends Controller
{
    public function viewMaterial($class)
    {
        if (!Teacher::where('user_id', Auth::user()->id)->exists() && !Admin::where('user_id', Auth::user()->id)->exists()) {
            $classId = Student::where('user_id', Auth::user()->id)->first()->class_id;
            $classStudent = School_class::where('id', $classId)->first()->class;

            $classTest = preg_replace('/[^0-9]/', '', $classStudent);
            $classStudentNumber = preg_replace('/[^0-9]/', '', $classTest);

            $currentClass = $classTest;

            if ($classStudentNumber >= $classTest) {
                $getClassId = School_class::where('class', $class)->first()->id;
                $materials = Exercise_Material::where('class_id', $getClassId)->get();
                $type_materials = Type_Material::all();

                return view('materials', compact('materials', 'type_materials', 'class'));
            } else {
                return redirect()->route("index");
            }
        } else {
            $classId = School_class::where('class', $class)->first()->id;
            $materials = Exercise_Material::where('class_id', $classId)->get();
            $type_materials = Type_Material::all();

            return view('materials', compact('materials', 'type_materials', 'class'));
        }
    }

    // public function search(Request $request)
    // {
    //     $searchedWord = $request->input('search');
    //     $class = $request->input('class');
    
    //     return redirect()->back()->with('searchedWord', $searchedWord);
    // }
    public function search(Request $request)
{
    $searchedWord = $request->input('search');
    $class = $request->input('class');
    if (!Teacher::where('user_id', Auth::user()->id)->exists() && !Admin::where('user_id', Auth::user()->id)->exists()) {
        $classId = Student::where('user_id', Auth::user()->id)->first()->class_id;
        $classStudent = School_class::where('id', $classId)->first()->class;

        $classTest = preg_replace('/[^0-9]/', '', $classStudent);
        $classStudentNumber = preg_replace('/[^0-9]/', '', $classTest);

        $currentClass = $classTest;

        if ($classStudentNumber >= $classTest) {
            $getClassId = School_class::where('class', $class)->first()->id;
            $materials = Exercise_Material::where('class_id', $getClassId)->get();
            $type_materials = Type_Material::all();

            return view('materials', compact('materials', 'type_materials', 'class'));
        } else {
            return redirect()->route("index");
        }
    } else {
        $classId = School_class::where('class', $class)->first()->id;
        $materials = Exercise_Material::where('class_id', $classId)->get();
        $type_materials = Type_Material::all();

        return view('materials', compact('searchedWord','materials', 'type_materials', 'class'));
    }
}


    public function searchWord(Request $request, $searchedWord, $class)
    {
        if (!Teacher::where('user_id', Auth::user()->id)->exists() && !Admin::where('user_id', Auth::user()->id)->exists()) {
            $classId = Student::where('user_id', Auth::user()->id)->first()->class_id;
            $classStudent = School_class::where('id', $classId)->first()->class;

            $classTest = preg_replace('/[^0-9]/', '', $classStudent);
            $classStudentNumber = preg_replace('/[^0-9]/', '', $classTest);

            $currentClass = $classTest;

            if ($classStudentNumber >= $classTest) {
                $getClassId = School_class::where('class', $class)->first()->id;
                $materials = Exercise_Material::where('class_id', $getClassId)->get();
                $type_materials = Type_Material::all();

                return view('materials', compact('materials', 'type_materials', 'class'));
            } else {
                return redirect()->route("index");
            }
        } else {
            $classId = School_class::where('class', $class)->first()->id;
            $materials = Exercise_Material::where('class_id', $classId)->get();
            $type_materials = Type_Material::all();

            return view('materials', compact('searchedWord','materials', 'type_materials', 'class'));
        }
    }
}
