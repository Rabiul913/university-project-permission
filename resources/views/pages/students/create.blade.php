@extends('layouts.app')

@section('title')
Create Student
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
              <h3 class="box-title">Create Student</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
          <form class="form-horizontal"  action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
              <div class="box-body">

              <div class="form-group">
                    <label for="student_id" class="col-sm-2 control-label">Student ID:</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="student_id" id="student_id" placeholder="student_id">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Student Name:</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name" id="name" placeholder="Student Name">
                    </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label" for="class_id">Select Class:</label>
                  <div class="col-sm-10">
                    <select id="class_id" name="class_id" class="form-control">
                    <option>----Select Class----</option>
                      @foreach($classes as $class)
                        <option value="{{$class->id}}">{{$class->name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>

                
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="section_id">Select Section:</label>
                  <div class="col-sm-10">
                    <select id="section_id" name="section_id" class="form-control">
                    <option>----Select Section----</option>
                    </select>
                  </div>
                </div>


                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email:</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="email" id="email" placeholder="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-sm-2 control-label">Mobile:</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="phone" id="phone" placeholder="phone">
                    </div>
                </div>
                  <div class="form-group">
                    <label for="present_address" class="col-sm-2 control-label">Present Address:</label>

                    <div class="col-sm-10">
                      <textarea name="present_address" id="" class="form-control" rows="5"></textarea>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="permanent_address" class="col-sm-2 control-label">Permanent Address:</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" name="permanent_address" id=""  rows="5"></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="image" class="col-sm-2 control-label">Photo:</label>

                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="image" id="image">
                    </div>
                  </div>
                   
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
              <a class="btn btn-danger" href="{{ route('students.index') }}">Cancle</a>
                <button type="submit" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
        <!-- /.col (right) -->
      </div>
@endsection