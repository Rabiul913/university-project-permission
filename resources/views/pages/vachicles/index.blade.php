@extends('layouts.app')

@section('title')
Vachicle
@endsection

@section('content')


<div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
              <h3 class="box-title"><a class="btn btn-success" href="{{ route('vachicles.create') }}">Create New Vachicle</a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Vachicle No.</th>
                  <th>Depurture Time</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($vachicles as $vachicle)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{$vachicle->name}}</td>
                  <td>{{$vachicle->vachicle_no}}</td>
                  <td>{{$vachicle->depurture_time}}</td>
                  <td>
                  <form action="{{ route('vachicles.destroy',$vachicle->id) }}" method="POST">
                    
                    <a class="btn btn-success" href="{{ route('vachicles.show',$vachicle->id) }}">Show</a>
              
                    <a class="btn btn-primary" href="{{ route('vachicles.edit',$vachicle->id) }}">Edit</a>
             
                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger">Delete</button>
              
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