@extends('layouts.app')

@section('title')
Route
@endsection

@section('content')


<div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
              @can($LRoute['create']) 
              <h3 class="box-title"><a class="btn btn-success" href="{{ route('routes.create') }}">Create New Route</a></h3>
              @endcan
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Vachicle No.</th>
                  <th>Destionation</th>
                  <th>Depurture Time</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($routes as $route)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $route->vachicle_id}}</td>
                  <td>{{$route->name}}</td>
                  <td>{{$route->time}}</td>
                  <td>
                  <form action="{{ route('routes.destroy',$route->id) }}" method="POST">
                    @can($LRoute['list'])  
                      <a class="btn btn-success" href="{{ route('routes.show',$route->id) }}">Show</a>
                    @endcan
                    @can($LRoute['edit'])
                        <a class="btn btn-primary" href="{{ route('routes.edit',$route->id) }}">Edit</a>
                    @endcan
                        @csrf
                        @method('DELETE')
                    @can($LRoute['delete'])
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