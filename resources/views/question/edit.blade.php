@extends('layout.app')
@section('CustomCSS')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('PageContent')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Question</h1>
                    </div>
                    <div class="col-sm-6">
                        
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Question Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="employee" method="POST" action="{{ route('questions.update', $Question['id']) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="Question">Question</label>
                                        <input type="text" name="question" class="form-control" id="question"
                                            placeholder="Enter question " value="{{ old('question') ? old('question') :$Question['question'] }}">
                                        @error('question')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="allotted_time">Allottad Time</label>
                                        <input type="text" name="allotted_time" class="form-control col-md-1" id="allotted_time"
                                            placeholder="Enter allotted time" value="{{ old('allotted_time') ? old('allotted_time'):$Question['allotted_time'] }}">
                                        @error('allotted_time')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <table class="table table-bordered" id="ansOption">
                                        <thead>
                                        <tr>
                                            <th scope="col">Option</th>
                                            <th scope="col">Is Answer</th>
                                            <th scope="col"><a class="addRow"><i class="fa fa-plus"></i></a></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Question->answeroptions as $answeroption )
                                          @php
                                              $row=0
                                          @endphp
                                            <tr>
                                                <td><input type="text" name="Options[{{ $row }}][Option]" class="form-control" 
                                                    value="{{  $answeroption->option }}"></td>
                                                <input type='hidden' value='off' name='Options[{{ $row }}][isans]'>
                                                <td><input type="checkbox" name="Options[{{ $row }}][isans]" class="form-control" value=" {{ $answeroption->is_ans }} 
                                                    {{ $answeroption->is_ans==1 ? 'checked' : '' }}" ></td>
                                                <td><a   class="btn btn-danger remove"> <i class="fa fa-remove">Remove</i></a></td>
                                            </tr> 
                                            @php
                                            $row=$row+1
                                        @endphp
                                            @endforeach
                                       
                                        </tbody>
                                    </table>

                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('customJs')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/validation.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.addRow').on('click', function () {
                addRow();
    
            });
    
            function addRow() {
                var rowCount = $('#ansOption  >tbody >tr').length;
                var addRow = '<tr>\n' +
    '                                <td><input type="text" name="Options['+ rowCount +'][Option]" class="form-control" ></td>\n' +
    '                                <input type="hidden" value="off" name="Options['+ rowCount +'][isans]">\n' +
    '                                <td><input type="checkbox" name="Options['+ rowCount +'][isans]" class="form-control" ></td>\n' +
    '                                <td><a   class="btn btn-danger remove"> <i class="fa fa-remove">Remove</i></a></td>\n' +
    '                             </tr>';
                $('tbody').append(addRow);
            };
    
            $('.remove').on('click', function () {
                var l =$('tbody tr').length;
                if(l==1){
                    alert('you cant delete last one')
                }else{
    
                    $(this).parent().parent().remove();
    
                }
    
            });
        });
    
    </script>
@endsection
