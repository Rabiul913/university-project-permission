@extends('layouts.app')

@section('title')
Route
@endsection

@section('content')

<div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
              <h3 class="box-title"><a class="btn btn-success" href="{{ route('routes.index') }}">Manage Routes</a></h3>
            </div>     
            <div class="box-body">
                <div class="form-group">
                  <div class="col-sm-2 control-label"><label>Route : </label></div>
                  <div class="col-md-8">
                  <select multiple="" class="form-control" id="id" name="id">
                    @foreach($routes as $route)
                    <option value="{{$route->id}}">{{$route->name}}</option>
                    @endforeach
                    </select>
                  </div>

                </div>
                <table  class="table table-bordered table-striped">
                    <thead>
                            <tr>
                        <th>SL</th>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Vachicle No</th>
                        </tr>
                      </thead>
                        <tbody id="routebody">

                        </tbody>
                </table>
            </div> 
          </div>
        </div>
      </div>
@endsection