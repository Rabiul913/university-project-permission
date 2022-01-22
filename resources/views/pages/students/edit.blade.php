@extends('layouts.app')

@section('title')
Update Student
@endsection
@section('content')
<div class="row">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif 

        <div class="col-md-12">
        <div class="box-header with-border">
            <h3 class="box-title"><a class="btn btn-success" href="{{ route('students.index') }}">Manage Students</a></h3>
            </div>
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Update Student</b></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
          <form class="form-horizontal"  action="{{ route('students.update',$student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
              <div class="box-body">

              <div class="form-group">
                    <label for="student_id" class="col-sm-2 control-label">Student ID:</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="{{$student->student_id}}" name="student_id" id="student_id" placeholder="student_id">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Student Name:</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="{{$student->name}}" name="name" id="name" placeholder="Student Name">
                    </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label" for="class_id">Select Class:</label>
                  <div class="col-sm-10">
                    <select name="class_id" class="form-control">
                    <option>----Select Class----</option>
                      @foreach($classes as $class)
                        <option @if($sectionClass->class_id == $class->id) selected="true" @endif value="{{$class->id}}">{{$class->name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>

                
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="section_id">Select Section:</label>
                  <div class="col-sm-10">
                    <select name="section_id" class="form-control">
                    <option>----Select Section----</option>
                    @foreach($sections as $section)
                        <option @if($sectionClass->section_id == $section->id) selected="true" @endif value="{{$section->id}}">{{$section->name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>


                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email:</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="{{$student->email}}" name="email" id="email" placeholder="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-sm-2 control-label">Mobile:</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="{{$student->phone}}" name="phone" id="phone" placeholder="phone">
                    </div>
                </div>
                  <div class="form-group">
                    <label for="present_address" class="col-sm-2 control-label">Present Address:</label>

                    <div class="col-sm-10">
                    <textarea name="present_address" id="" class="form-control" rows="5">{{$student->present_address}}</textarea>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="permanent_address" class="col-sm-2 control-label">Permanent Address:</label>

                    <div class="col-sm-10">
                    <textarea name="permanent_address" id="" class="form-control" rows="5">{{$student->permanent_address}}</textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="image" class="col-sm-2 control-label">Photo:</label>

                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="image" id="image">
                      <img src="/image/students/{{ $student->image }}" width="300px">
                    </div>
                  </div>
                   
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
              <a class="btn btn-danger" href="{{ route('students.index') }}">Cancle</a>
                <button type="submit" class="btn btn-info pull-right">Update</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
        <!-- /.col (right) -->
      </div>
@endsection