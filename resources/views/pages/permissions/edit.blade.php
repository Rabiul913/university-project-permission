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
                <h3 class="box-title"><a class="btn btn-success" href="{{ route('permissions.index') }}">Manage Permissions</a></h3>
                </div>
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Update Permission</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal"  action="{{ route('permissions.update',$permission->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="box-body">
                        <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Permission Name</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{ $permission->name }}" id="name" placeholder="Permission Name">
                        </div>
                        </div>
                        <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Http Uri</label>
                        <div class="col-sm-10">
                            <select name="http_uri[]" id="" class="form-control"  multiple="multiple">
                                <option value="" selected>----Select Uri----</option>
                            @foreach ($routes as $route)
                            @if ($route->getprefix()=='student')
                            <option value="{{ $route->methods()[0]}}:: {{ $route->uri() }}">
                                <b>{{ $route->methods()[0]}}:: {{ $route->uri() }}</b>
                            </option> 
                            @endif                
                            @endforeach
                            </select>
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
</div>
@endsection