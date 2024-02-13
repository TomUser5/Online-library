<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise_Material extends Model
{
    use HasFactory;

    protected $table = 'exercise_materials';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'location',
        'type_material_id',
        'subject_id',
        'class_id',
        'teacher_id',
    ];

    // public function prescriptions()
    // {
    //     return $this->belongsToMany(Prescription::class, 'disease_prescription');
    // }
    public function type_material()
    {
        return $this->belongsTo(Type_Material::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function class()
    {
        return $this->belongsTo(School_class::class);
    
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}