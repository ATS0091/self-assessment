<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answeroption;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Question=Question::all();
        $QuestionCount=$Question->count();
        
        return view('exam.index',compact('QuestionCount'));
    }

    /**
     * Show the form for starting a new exam.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    Public function startExam(Request $request)
    {
        $data = $request->validate([
            'noofquest' => 'required',
        ]);
        $countExamQuestion=$data['noofquest'];
        $currentQuestion=1;
        $nextQuestion=$currentQuestion+1;
        $Question=Question::inRandomOrder()->first();
        session(['countExamQuestion'=>$countExamQuestion]);
        session(['currentQuestion'=>$currentQuestion]); 
        session(['nextQuestion'=>$nextQuestion]); 
        Session(['score'=> 0]);     
         return view('exam.start',compact('Question','countExamQuestion','currentQuestion'));
    }
    

    /**
     * get a new question resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function getQuestion(Request $request,$count)
    {     
 
        $QuestionId=$request['questionid'];
        $answer=$request['$answer'];
        $matchThese = ['id'=>$answer,'question_id' => $QuestionId, 'is_ans' => 1];
        $option=Answeroption::where($matchThese)->get();
        $Score=session('score');
       if(!empty($option)){
           $Score+=1;
            session(['score'=>$Score]);
       }
        $Question=Question::inRandomOrder()->first();
        $currentQuestion=$count;
        $nextQuestion=$currentQuestion+1;
        session(['nextQuestion'=>$nextQuestion]); 
        session(['currentQuestion'=>$currentQuestion]);
        if(session('countExamQuestion')>=$currentQuestion){
             return view('exam.start',compact('Question','currentQuestion'));
        }
        else
        {
            return view('exam.result');
        }
        


    }
   
}
