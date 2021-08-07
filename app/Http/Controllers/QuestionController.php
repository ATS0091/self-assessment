<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        return view('question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('question.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $storeData = $request->validate([
            'question' => 'required',
            'allotted_time' => 'required',
        ]);
        $question = Question::create($storeData);
        foreach ($request->Options as $Option) {
            $question->answeroptions()->create([
                'question_id'=>$question->id,
                'option' => $Option['Option'],
                'is_ans' => $Option['isans']=='on' ? 1:0 
            ]);

            
        }

        return redirect(route('questions.index'))->with('completed', 'Question created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Question = Question::findOrFail($id);
        return view('question.edit', compact('Question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'question' => 'required',
            'allottedTime' => 'required',
        ]);
       
        Question::whereId($id)->update($data);
        return redirect(route('questions.index'))->with('completed', 'Question updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect(route('questions.index'))->with('completed', 'Euestion deleted');
    }
}
