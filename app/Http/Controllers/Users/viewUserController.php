<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\School_class;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class viewUserController extends Controller
{
    public function viewUsers($class)
    {
        try {
            // Get the class ID
            $classId = School_class::where('class', $class)->firstOrFail()->id;
    
            // Get the IDs of students in the class
            $studentIds = Student::where('class_id', $classId)->pluck('user_id');
    
            // Get the users data for the students in the class
            $students = User::whereIn('id', $studentIds)
            ->orderBy('first_name')
            ->orderBy('middle_name')
            ->orderBy('last_name')
            ->get();
    
            // Pass the $students data to the view
            return view('users', compact('students', 'class'));
        } catch (\Exception $e) {
            // Handle any exceptions, maybe return an error view or message
            return view('error_view', ['message' => $e->getMessage()]);
        }
    }
}
