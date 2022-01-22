@extends('layouts.app')

@section('title')
Classes
@endsection

@section('content')


<div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
              <h3 class="box-title"><a class="btn btn-success" href="{{ route('class.create') }}">Create New Class</a></h3>
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

                @foreach($classes as $class)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{$class->name}}</td>
                  <td>
                  <form action="{{ route('class.destroy',$class->id) }}" method="POST">
                  @can($LClass['list'])
                    <a class="btn btn-success" href="{{ route('class.show',$class->id) }}">Show</a>
                @endcan
                @can($LClass['edit'])
                    <a class="btn btn-primary" href="{{ route('class.edit',$class->id) }}">Edit</a>
                @endcan
                    @csrf
                    @method('DELETE')
                @can($LClass['delete'])
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