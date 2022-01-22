@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
        <div class="card">
            <div class="card-header">Users
                @can('admin-create')
                    <span class="float-right">
                        <a class="btn btn-success" href="{{ route('users.create') }}">Create New User</a>
                    </span>
                @endcan
            </div>
            <div class="card-body">
                <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>

                        @foreach($users as $key=>$user)
                        <tr>
                            <td>{{++$i}}</td>
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
                                <a class="btn btn-success" href="{{route('users.show',$user->id)}}">Show</a>
                            @can('admin-edit')
                                <a class="btn btn-primary" href="{{route('users.edit',$user->id)}}">Edit</a>
                            @endcan  
                            @can('admin-delete') 
                                {!! Form::open(['method'=>'DELETE','route'=>['users.destroy',$user->id],'style'=>'display:inline']) !!}

                                {!! Form::submit('Delete',['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @endcan
                        </td>
                            <td></td>
                        </tr>
                        @endforeach
                    </table>

         </div>
        </div>
    </div>
</div>

@endsection