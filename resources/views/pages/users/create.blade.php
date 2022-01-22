@extends('layouts.app')

@section('title')
Create User
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
            <h3 class="box-title"><a class="btn btn-success" href="{{ route('users.index') }}">Manage Users</a></h3>
            </div>
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Create User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{ route('users.store') }}" method="POST">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">UserName:</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="UserName">
                  </div>
                </div>
                <div class="form-group">
                  <label for="email" class="col-sm-2 control-label">Email:</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter your Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password" class="col-sm-2 control-label">Password:</label>

                  <div class="col-sm-10">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="confirm-password" class="col-sm-2 control-label">Retype Password:</label>

                  <div class="col-sm-10">
                  <input type="password" class="form-control" name="confirm-password" id="password" placeholder="Enter your password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="role" class="col-sm-2 control-label">Role:</label>

                  <div class="col-sm-10">
                  {!! Form::select('roles[]',$roles,[],array('class'=>'form-control','multiple')) !!}
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