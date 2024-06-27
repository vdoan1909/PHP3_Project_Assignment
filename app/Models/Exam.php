<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "time_limit",
        "number_of_questions",
        "description",
        "subject_id",
        "slug",
    ];

    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
