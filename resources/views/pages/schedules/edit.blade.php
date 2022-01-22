@extends('layouts.app')

@section('title')
Create Schedule
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
            <h3 class="box-title"><a class="btn btn-success" href="{{ route('schedules.index') }}">Manage Schedules</a></h3>
            </div>
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Create Schedule</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  action="{{ route('schedules.store') }}" method="POST">
            @csrf
              <div class="box-body">

              <div class="form-group">
                  <div class="col-sm-2 control-label"><label>Student Name</label></div>
                  <div class="col-md-8">
                  <select multiple="" class="form-control" name="student_id">
                  @foreach($students as $student)
                    <option @if($schedule->student_id == $student->id) selected="true" @endif value="{{$student->id}}">{{$student->name}}</option>
                    @endforeach
                  </select>
                  </div>
                
                </div>

                <div class="form-group">
                  <div class="col-sm-2 control-label"><label>Route Name:</label></div>
                  <div class="col-md-8">
                  <select multiple="" class="form-control" name="route_id">
                  @foreach($routes as $route)
                    <option @if($schedule->route_id == $route->id) selected="true" @endif value="{{$route->id}}">{{$route->name}}</option>
                    @endforeach
                  </select>
                  </div>
                
                </div>

                <div class="form-group">
                  <div class="col-sm-2 control-label"><label>Start Point:</label></div>
                  <div class="col-md-8">
                  <select multiple="" class="form-control" name="start_stop_id">
                  @foreach($stops as $stop)
                    <option @if($schedule->start_stop_id == $stop->id) selected="true" @endif value="{{$stop->id}}">{{$stop->name}}</option>
                    @endforeach
                  </select>
                  </div>
                
                </div>

                <div class="form-group">
                  <div class="col-sm-2 control-label"><label>End Point:</label></div>
                  <div class="col-md-8">
                  <select multiple="" class="form-control" name="end_stop_id">
                  @foreach($stops as $stop)
                    <option @if($schedule->end_stop_id == $stop->id) selected="true" @endif value="{{$stop->id}}">{{$stop->name}}</option>
                    @endforeach
                  </select>
                  </div>
                
                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-danger">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
        <!--/.col (right) -->
      </div>
@endsection