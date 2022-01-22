
@extends('layouts.app')

@section('title')
Permissions
@endsection

@section('content')


<div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
              @can($LPermission["create"])
              <h3 class="box-title"><a class="btn btn-success" href="{{ route('permissions.create') }}">Create New Permission</a></h3>
              @endcan
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Http Uri</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($data as $key => $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->http_uri }}</td>
                                <td>
                                  @can($LPermission["list"])
                                    <a class="btn btn-success" href="{{ route('permissions.show',$permission->id) }}">Show</a>
                                  @endcan
                                  @can($LPermission["edit"])
                                        <a class="btn btn-primary" href="{{ route('permissions.edit',$permission->id) }}">Edit</a>
                                  @endcan
                                  @can($LPermission["delete"])
                                        {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                </tbody>
                <tfoot>
              </table>
              {{ $data->appends($_GET)->links() }}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
@endsection
