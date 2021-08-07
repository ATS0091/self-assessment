@extends('layout.exam.app')
@section('PageContent')
<div class="container">
    <p>This is a self-assessment exam portal. You can choose a number of questions and then start the exam.</p>
            <form id="iniExam" method="POST" action=" {{ route('exam.start') }} " enctype='multipart/form-data'>
                @csrf
                <label for="choose NuofQuest">Number of Questions(Input between 1 to {{ $QuestionCount }})</label>
                <input type="number" name="noofquest" id="noofquest" class="form-control col-md-1" min="1" max={{"$QuestionCount"}} required>
                <br>
                <button class="btn btn-success">Start</button>
            </form>
    
        </div>
@endsection