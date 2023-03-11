<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = ['question','image','answer'];

    public function getQuiz()
    {
        return $this->all();
    }

    public function checkQuiz($answer)
    {
        return $this->where('answer',$answer)->first();
    }
}
