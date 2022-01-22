@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
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
        <div class="card">
            <div class="card-header"><b>Update user</b>
                <span class="float-right">
                    <a class="btn btn-success" href="{{ route('users.index') }}">Manage Users</a>
                </span>
            </div>

        <div class="card-body">

            {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm 12">
                    <div class="form-group">
                    <strong>Name* :</strong>
                {!! Form::text('name',null, array('placeholder'=>'Enter your Name','class'=>'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-md-12 col-sm 12">
                    <div class="form-group">
                    <strong>Email* :</strong>
                {!! Form::text('email',null, array('placeholder'=>'Enter your Email','class'=>'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-md-12 col-sm 12">
                    <div class="form-group">
                    <strong>Password* :</strong>
                {!! Form::password('password',array('placeholder'=>'Enter your Password','class'=>'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-md-12 col-sm 12">
                    <div class="form-group">
                    <strong>Confirm Password</strong>
                {!! Form::password('confirm-password',array('placeholder'=>'Re-type Password','class'=>'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-md-12 col-sm 12">
                    <div class="form-group">
                    <strong>Role :</strong>
                {!! Form::select('roles[]',$roles,$userRole,array('class'=>'form-control','multiple')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-md-12 col-sm 12 text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </div>

            {!! Form::close() !!}
            </div>
        </div>

    </div>
</div>

@endsection