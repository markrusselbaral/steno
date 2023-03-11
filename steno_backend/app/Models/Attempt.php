<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    use HasFactory;
    protected $fillable = ['attempt','user_id','quiz_id'];

    public function saveAttempt($data)
    {
        return $this->create($data);
    }
}
