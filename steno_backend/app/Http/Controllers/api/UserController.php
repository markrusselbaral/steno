<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use App\Models\Attempt;


class UserController extends Controller
{

    function __construct()
    {
        $this->user = new User;
        $this->attempt = new Attempt;
    }



    public function save(Request $request)
    {

        $quiz = DB::table('quizzes')->pluck('id')->toArray();
        $count = DB:: table('quizzes')->count();
        $data = ['name' => $request->name];
        $id = $this->user->saveUser($data);

        foreach($quiz as $quizzes)
        {

            foreach (range(1, $count) as $value) 
            {
                $attempt = [
                    'attempt' => 1,
                    'user_id' => $id,
                    'quiz_id' => $quizzes
                ];
                
                 
            }
            $this->attempt->saveAttempt($attempt);
        }

       $user_quiz =  DB::table('quizzes')
            ->join('attempts','attempts.quiz_id','=', 'quizzes.id')
            ->select('quizzes.*','attempts.*')
            ->where('attempts.user_id',$id)
            ->where('attempts.attempt',1)
            ->first();
            return response()->json(['user_quiz' => $user_quiz]);

    }  
}
