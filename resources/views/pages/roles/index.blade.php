@extends('layouts.app')

@section('title')
Roles
@endsection

@section('content')


<div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
              @can($LRole['create'])
              <h3 class="box-title"><a class="btn btn-success" href="{{ route('roles.create') }}">Create New Role</a></h3>
            @endcan
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($roles as $role)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{$role->name}}</td>
                  <td>
                  <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
                    @can($LRole['list'])
                    <a class="btn btn-success" href="{{ route('roles.show',$role->id) }}">Show</a>
                    @endcan
                   
                    @can($LRole['edit'])
                    <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                    @endcan
                    
                    @can($LRole['delete'])
                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>

                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
@endsection