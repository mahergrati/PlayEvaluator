<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizScore extends Model
{
    use HasFactory;

    protected $table = 'quiz_scores';

    protected $fillable = [
        'score',
    ];
}
