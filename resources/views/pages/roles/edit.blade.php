@extends('layouts.app')
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
                <h3 class="box-title"><a class="btn btn-success" href="{{ route('roles.index') }}">Manage Permissions</a></h3>
                </div>
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Update Roles</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="card-body">
                    {!! Form::model($role, ['route' => ['roles.update', $role->id],'method' => 'PATCH']) !!}
                        <div class="form-group">
                            <strong>Name:</strong>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                        <div class="form-group">
                            <strong>Permission:</strong>
                            <br/>
                            @foreach($permission as $value)
                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                {{ $value->name }}</label>
                            <br/>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    {!! Form::close() !!}
                </div>
            </div>
            </div>
            <!--/.col (right) -->
        </div>
</div>
@endsection
