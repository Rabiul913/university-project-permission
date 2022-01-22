@extends('layouts.app')

@section('title')
Create Route
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
            <h3 class="box-title"><a class="btn btn-success" href="{{ route('routes.index') }}">Manage Routes</a></h3>
            </div>
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Create Route</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
          <form class="form-horizontal"  action="{{ route('routes.store') }}" method="POST">
            @csrf
              <div class="box-body">

              <div class="form-group">
                  <label class="col-sm-2 control-label" for="class_id">Vachicle Name:</label>
                  <div class="col-sm-10">
                    <select id="vachicle_id" name="vachicle_id" class="form-control">
                    <option>----Select vachicle----</option>
                      @foreach($vachicles as $vachicle)
                        <option value="{{$vachicle->id}}">{{$vachicle->name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Destionation</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="destination">
                  </div>
                </div>
                <div class="form-group">
                  <label for="time" class="col-sm-2 control-label">Time</label>

                  <div class="col-sm-10">
                    <input type="datetime-local" class="form-control" name="time" id="time" >
                  </div>
                </div>

            
      
       
                   
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
              <a class="btn btn-danger" href="{{ route('routes.index') }}">Cancle</a>
                <button type="submit" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
        <!-- /.col (right) -->
      </div>
@endsection