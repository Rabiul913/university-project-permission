@extends('layouts.app')

@section('title')
Create Class
@endsection
@section('content')
<div class="row">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif 

        <div class="col-md-12">
        <div class="box-header with-border">
            <h3 class="box-title"><a class="btn btn-success" href="{{ route('sections.index') }}">Manage Sections</a></h3>
            </div>
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Update Section</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            @php //dd($sectionClass); @endphp
            <form class="form-horizontal"  action="{{ route('sections.update',$section->id) }}" method="POST">
            @csrf
            @method('put')
              <div class="box-body">
              <div class="form-group">
                  <div class="col-sm-2 control-label"><label>Class Name</label></div>
                  <div class="col-md-8">
                  <select multiple="" class="form-control" name="class_id">
                      
                  @foreach($classes as $class)
                            <option @if($sectionClass->id == $class->id) selected="true" @endif value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Section Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="{{$section->name}}" id="name" placeholder="Class Name">
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-danger">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Update</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
        <!--/.col (right) -->
      </div>
@endsection