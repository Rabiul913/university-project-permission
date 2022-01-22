@extends('layouts.app')

@section('title')
Create Vachicle
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
            <h3 class="box-title"><a class="btn btn-success" href="{{ route('vachicles.index') }}">Manage Vachicles</a></h3>
            </div>
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Create Vachicle</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  action="{{ route('vachicles.store') }}" method="POST">
            @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Vachicle Name:</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Vachicle Name">
                  </div>
                </div>

                <div class="form-group">
                  <label for="vachicle_no" class="col-sm-2 control-label">Vachicle No.:</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="vachicle_no" id="vachicle_no" placeholder="Vachicle No.">
                  </div>
                </div>

                <div class="form-group">
                  <label for="depurture_time" class="col-sm-2 control-label">Depurture Time:</label>

                  <div class="col-sm-10">
                    <input type="datetime-local" class="form-control" name="depurture_time" id="depurture_time">
                  </div>
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