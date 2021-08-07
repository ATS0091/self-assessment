
@extends('layout.exam.app')
@section("PageContent")

<div class="panel panel-default">
    <div class="panel-body mb0">
        <div class="row">
            <div class="col-lg-12">
                <div style="" class="tab-content div-question mb0" id="page01">
                    <div class="question-height">
                        <div class="row">
                            <div class="col md-3">
                                 <h4 class="question-title"> Question {{ session('currentQuestion') }} </h4>
                            </div>
                            <div class="col md-9">
                                <h5>Time:<span id="exam_timer" class="timer-title time-started"></span></h5>
                                
                           </div>
                        </div>
                        
                    <form action=" {{ route('exam.getQuestion',session('nextQuestion'))}} " method="post" name='exam' id='exam'>
                       @csrf
                        <p> {{ $Question->question }} </p> <br>
                        <input type="hidden" value={{ $Question->id}} name="questionid">
                        <table class="table table-borderless mb0">
                            <tbody>
                                <tr>
                                    @foreach ($Question->answeroptions as $answeroption)
                                         <td> <input type="radio" value=" {{$answeroption->id}} " name="answer" id="answer" > {{ $answeroption->option }}  </td>
                                    @endforeach                                 
                                </tr>
                            </tbody>
                        </table>
                        
                    </form>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12"> 
                                        <a href="javascript:void(0);" onclick="submit_exam()" class="btn btn-success btn-submit-all-answers pull-right" id="submit">Finish Exam</a>
                                        &nbsp;&nbsp; 
                                        &nbsp;&nbsp; 
                                        <a href="javascript:void(0);" onclick="load_question()" class="btn btn-default pull-left" id="next">Next >></a>
                                        &nbsp;&nbsp; 
                                    </div>
                                </div>
                            </div>   
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 


@endsection

@section('customJs')
<script>

    // var allotted_time=document.getElementById('allotted_time').value;
    // var ExamQuestionCount=document.getElementById('examQuestionCount').value;
     var CurrentQuestion = {{ session('currentQuestion') }};
    var QuestTimeout={{ $Question->allotted_time }};
    var totalQuest= {{ session('countExamQuestion') }} ;

    function load_question() {
        if (this.CurrentQuestion+1 != 0 && this.totalQuest >= this.CurrentQuestion+1 ) {
            document.getElementById('exam').submit();
                }
            else{
                submit_exam();  
                }
            }

            var x = setInterval(function()
            {
                this.QuestTimeout--;
                var distance = this.QuestTimeout;
                    
                if (distance <= 0) {
                    clearInterval(x);
                    time_expired();
                } else {
                    update_timer(distance);
                }

  
            }, 1000);
            
            function time_expired()
            {
                if (this.CurrentQuestion+1 != 0 && this.totalQuest >= this.CurrentQuestion+1 ) {
            document.getElementById('exam').submit();
                }
                else{
                submit_exam();  
                }
               
            }

            function update_timer(timestring)
            {
                document.getElementById("exam_timer").innerHTML = timestring;
            }

            function submit_exam(){
                document.getElementById('exam').submit();
            }


</script>   
@endsection