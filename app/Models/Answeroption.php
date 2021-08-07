<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Question\Question;

class Answeroption extends Model
{
    use HasFactory;

    protected $fillable = [
        'option', 
        'question_id',
        'is_ans', 
    ];

    public function AnsweroptionsQuestion()
    {
        return $this->belongsTo('Question');
    }


}
