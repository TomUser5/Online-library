<?php

namespace App\Http\Controllers\Materials;

use App\Http\Controllers\Controller;
use App\Models\Exercise_Material;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class deleteMaterialController extends Controller
{
    public function deleteMaterial($materialId)
    {
        try {
            $fileLocation = Exercise_Material::where('id', '=', $materialId)->value('location');
            
            // Construct the full file path
            $file_path = public_path($fileLocation);
            
            unlink($file_path);

            Exercise_Material::where('id', '=', $materialId)
                ->delete();

            session()->flash('success', 'Материалът е успешно изтрит!');
            return redirect()->route('index');
        } catch (\Exception $e) {
            return "Грешка при изтриването на материала: " . $e->getMessage();
        }
    }
}
