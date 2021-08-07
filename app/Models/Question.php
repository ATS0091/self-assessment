<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question', 
        'allotted_time', 
    ];

    public function answeroptions()
    {
        return $this->hasMany(Answeroption::class);
    }


}
