<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class addAuthorController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'first_name' => 'required',
                'last_name' => 'required',
            ],
            [
                'first_name.required' => 'Полето е задължително да се попълни!',
                'last_name.required' => 'Полето е задължително да се попълни!',
            ]
        );

        $author = new Author();
        $author->fill([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
        ]);

        $author->save();

        session()->flash('success', 'Автора е успешно добавен!');
        return redirect()->route('index');
    }
}
