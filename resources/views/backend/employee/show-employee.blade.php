@extends('backend.includes.master')
@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Employee List</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>SI</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
         @foreach ($employees as $employee )
         <tr>
          <td>{{$loop->index+1}}</td>
          <td>{{$employee->name}}</td>
          <td>{{$employee->email}}</td>
          <td>{{$employee->role}}</td>
          <td>
           <a href="{{url('/admin/edit-employees/'.$employee->id)}}" class="btn btn-primary">Edit</a>
           {{--<a href="" class="btn btn-danger" onclick="return confirm('Are you sure')" >Delete</a>--}}
          </td>

        </tr>
         @endforeach
   
        </tbody>
     
      </table>
    </div>
    <!-- /.card-body -->

  </div>

@endsection
