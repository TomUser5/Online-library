<?php

namespace App\Http\Controllers\TypeFile;

use App\Http\Controllers\Controller;
use App\Models\Type_Material;
use Illuminate\Http\Request;

class addTypeFile extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'type' => 'required',
            ],
            [
                'type.required' => 'Полето е задължително да се попълни!',
            ]
        );

        $type = new Type_Material();
        $type->fill([
            'type_material' => $request['type'],
        ]);

        $type->save();

        session()->flash('success', 'Вида файл е успешно добавен!');
        return redirect()->route('index');
    }
}
