@extends('layouts.app')

@section('title')
Stop
@endsection

@section('content')


<div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
              @can($LStop['create'])
              <h3 class="box-title"><a class="btn btn-success" href="{{ route('stops.create') }}">Create New Stop</a></h3>
              @endcan
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Route</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($stops as $stop)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{$stop->route_id}}</td>
                  <td>{{$stop->name}}</td>
                  <td>
                  <form action="{{ route('stops.destroy',$stop->id) }}" method="POST">
                    @can($LStop['list'])
                    <a class="btn btn-success" href="{{ route('stops.show',$stop->id) }}">Show</a>
                    @endcan
                   
                    @can($LStop['edit'])
                    <a class="btn btn-primary" href="{{ route('stops.edit',$stop->id) }}">Edit</a>
                    @endcan
                    
                    @can($LStop['delete'])
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