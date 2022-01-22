@extends('layouts.app')

@section('title')
Schedule
@endsection

@section('content')


<div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                @can($LRDetail['create'])
                <a class="btn btn-success" href="{{ route('schedules.create') }}">Create New Schedule</a>
                @endcan
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Student Name</th>
                  <th>Route Name</th>
                  <th>Start Point</th>
                  <th>End Point</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>           
            @foreach($schedules as $schedule)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{$schedule->sname}}</td>
                  <td>{{$schedule->rname}}</td>
                  <td>{{$schedule->stname}}</td>

                
                 <td>{{$stops[$j++]->ename}}</td>
                
                    <td>
                  <form action="{{ route('schedules.destroy',$schedule->id) }}" method="POST">
                   @can($LRDetail['list']) 
                    <a class="btn btn-success" href="{{ route('schedules.show',$schedule->id) }}">Show</a>
                  @endcan
                  @can($LRDetail['edit'])
                    <a class="btn btn-primary" href="{{ route('schedules.edit',$schedule->id) }}">Edit</a>
                  @endcan
                    @csrf
                    @method('DELETE')

                    @can($LRDetail['delete'])
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