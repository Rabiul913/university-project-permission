@extends('layouts.app')

@section('title')
Create Stop
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
            <h3 class="box-title"><a class="btn btn-success" href="{{ route('stops.index') }}">Manage Stops</a></h3>
            </div>
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Create Stop</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
          <form class="form-horizontal"  action="{{ route('stops.store') }}" method="POST">
            @csrf
              <div class="box-body">

              <div class="form-group">
                  <label class="col-sm-2 control-label" for="route_id">Route Name:</label>
                  <div class="col-sm-10">
                    <select id="route_id" name="route_id" class="form-control">
                    <option>----Select route----</option>
                      @foreach($routes as $route)
                        <option value="{{$route->id}}">{{$route->name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="name">
                  </div>
                </div>
                          
      
       
                   
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
              <a class="btn btn-danger" href="{{ route('stops.index') }}">Cancle</a>
                <button type="submit" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
        <!-- /.col (right) -->
      </div>
@endsection