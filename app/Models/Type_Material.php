<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_Material extends Model
{
    use HasFactory;

    protected $table = 'type_materials';

    public $timestamps = false;

    protected $fillable = [
        'type_material',
    ];
}
