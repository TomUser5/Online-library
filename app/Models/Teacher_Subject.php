<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher_Subject extends Model
{
    use HasFactory;

    protected $table = 'teacher_subject';

    public $timestamps = false;

    protected $fillable = [
        'teacher_id',
        'subject_id',
    ];
}
