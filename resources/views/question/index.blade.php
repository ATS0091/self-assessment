@extends('layout.app')
@section('PageContent')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-9">
                        <h1>Questions</h1>
                    </div>
                    <div class="col-sm-3">
                        {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Employees</li>
            </ol> --}}
                        <a class="btn btn-block btn-primary" href="{{ route('questions.create') }}"> New Question</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="QuestionDatatable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>AllottedTime</th>
                                            <th>Answer</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($questions as $question)
                                            <tr>
                                                <td>{{ $question->question }}</td>
                                                <td>{{ $question->allotted_time }}</td>
                                                @foreach ($question->answeroptions as $answeroption)
                                                    @if($answeroption->is_ans==1)
                                                         <td>{{ $answeroption->option }}</td>
                                                    @endif
                                                   
                                                @endforeach
                                                
                                                <td class="text-left">
                                                    <a href="{{ route('questions.edit', $question->id) }}"
                                                        class="btn btn-success btn-sm">Edit</a>
                                                    <form action="{{ route('questions.destroy', $question->id) }}" method="post"
                                                        style="display: inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('are you sure?.')"
                                                            type="submit">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
