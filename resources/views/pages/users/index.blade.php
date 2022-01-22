@extends('layouts.app')

@section('title')
Users
@endsection

@section('content')


<div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
              @can($LUser['create'])
              <h3 class="box-title"><a class="btn btn-success" href="{{ route('users.create') }}">Create New User</a></h3>
              @endcan
          
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                            @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                            <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                            @endif
                    </td>
                  <td>
                    <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                        @can($LUser['list'])
                        <a class="btn btn-success" href="{{ route('users.show',$user->id) }}">Show</a>
                        @endcan
                        @can($LUser['edit'])
                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                        @endcan
                        @can($LUser['delete'])
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