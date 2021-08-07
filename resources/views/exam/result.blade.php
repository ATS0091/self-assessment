@extends('layout.exam.app')
@section('PageContent')

<div class="container">
    <table class="table" style="border: solid">
        <tbody>
            <tr>
                <td>Total Questions</td>
                <td> {{ session('countExamQuestion') }} </td>
            </tr>
            <tr>
                <td>Score</td>
                <td> {{session('score');}} </td>
            </tr>
        </tbody>
    </table>
</div>

    
@endsection