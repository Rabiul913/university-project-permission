@extends('layouts.app')

@section('title')
Sections
@endsection

@section('content')


<div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
              <h3 class="box-title"><a class="btn btn-success" href="{{ route('sections.create') }}">Create New Section</a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Class Name</th>
                  <th>Section Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($sections as $section)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $section->class_name }}</td>
                  <td>{{$section->name}}</td>
                  <td>
                  <form action="{{ route('sections.destroy',$section->id) }}" method="POST">
                    
                    <a class="btn btn-success" href="{{ route('sections.show',$section->id) }}">Show</a>
              
                    <a class="btn btn-primary" href="{{ route('sections.edit',$section->id) }}">Edit</a>
             
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