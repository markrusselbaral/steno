<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use DB;

class QuizController extends Controller
{
    function __construct()
    {
        $this->quiz = new Quiz;
    }

    public function index()
    {
        $data = $this->quiz->getQuiz();
        return response()->json($data);
    }

    public function check(Request $request)
    {
        $check = $this->quiz->checkQuiz($request->answer);

        $user_quiz =  DB::table('quizzes')
                ->join('attempts','attempts.quiz_id','=', 'quizzes.id')
                ->select('quizzes.*','attempts.*')
                ->where('attempts.user_id',$request->uid)
                ->where('attempts.attempt',1)
                ->first();
        
        if($check)
        {   
            DB::table('attempts')
                ->where('quiz_id',$request->quiz_id)
                ->where('user_id',$request->user_id)
                ->update(['attempt' => 0]);

            return response()->json(['user_quiz' => $user_quiz, 'message' => 'You are correct']);

        }
        else{
            DB::table('attempts')
                ->where('quiz_id',$request->quiz_id)
                ->where('user_id',$request->user_id)
                ->update(['attempt' => 0]);
            return response()->json(['user_quiz' => $user_quiz, 'message' => 'Oops']);
        }

    }
}
