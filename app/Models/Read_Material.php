<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Read_Material extends Model
{
    use HasFactory;

    protected $table = 'read_materials';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'location',
        'type_material_id',
        'subject_id',
        'class_id',
        'author_id',
        'teacher_id',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
