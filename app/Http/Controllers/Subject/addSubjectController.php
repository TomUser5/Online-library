<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class addSubjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'subject' => 'required',
            ],
            [
                'subject.required' => 'Полето е задължително да се попълни!',
            ]
        );

        $subject = new Subject();
        $subject->fill([
            'subject' => $request['subject'],
        ]);

        $subject->save();

        session()->flash('success', 'Учебния предмет е успешно добавен!');
        return redirect()->route('index');
    }
}
