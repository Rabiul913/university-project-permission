@extends('layouts.app')

@section('title')
Students
@endsection

@section('content')


<div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                @can($LStudent['create'])
                <a class="btn btn-success" href="{{ route('students.create') }}">Create New Student</a>
              @endcan
            </h3>
              <h3 class="box-title" style="float:right;">
                <a class="btn btn-success" href="{{url("export")}}">Export Excel Sheet</a>
          </h3>
            </div>
            <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>

                        </div>
                        <br>
                    @endif
                    @can($LStudent['create'])
                    <form action="{{url("import")}}" method="post" enctype="multipart/form-data">

                        @csrf

                        <fieldset>

                            <label>Select File to Upload  <small class="warning text-muted">{{__('Please upload only Excel (.xlsx or .xls) files')}}</small></label>

                            <div class="input-group">
                              <div class="row">

                                <div class="col-md-8">
                                  <input type="file" required class="form-control" name="uploaded_file" id="uploaded_file">
                                </div>

                                @if ($errors->has('uploaded_file'))

                                    <p class="text-right mb-0">

                                        <small class="danger text-muted" id="file-error">{{ $errors->first('uploaded_file') }}</small>

                                    </p>

                                @endif
                                <div class="col-md-4">
                                  <button class="btn btn-success square" type="submit"><i class="ft-upload mr-1"></i> Import</button>
                                </div>

                                
                              </div>
                           
                            </div>

                        </fieldset>

                    </form>
                    @endcan

                    </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Image</th>
                  <th>Student ID</th>
                  <th>Name</th>
                  <th>Present Address</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($students as $student)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td><img src="/image/students/{{ $student->image }}" width="100px"></td>
                  <td>{{$student->student_id}}</td>
                  <td>{{$student->name}}</td>
                  <td>{{$student->present_address}}</td>
                
                  <td>{{$student->phone}}</td>
                  <td>{{$student->email}}</td>
                  <td>
                  <form action="{{ route('students.destroy',$student->id) }}" method="POST">
                   @can($LStudent['list']) 
                    <a class="btn btn-success" href="{{ route('students.show',$student->id) }}">Show</a>
                  @endcan
                  @can($LStudent['edit'])
                    <a class="btn btn-primary" href="{{ route('students.edit',$student->id) }}">Edit</a>
                  @endcan
                    @csrf
                    @method($LStudent['delete'])
                  @can('student-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                  @endcan
                </form>

                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
@endsection