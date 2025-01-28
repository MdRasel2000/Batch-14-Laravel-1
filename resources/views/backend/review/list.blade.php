@extends('backend.includes.master')
@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Review List</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>SI</th>
          <th>Image</th>
          <th>Customer Name</th>
          <th>Custmer Status</th>
          <th>Product Name</th>
          <th>Rating</th>
          <th>Comments</th>      
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
         @foreach ( $reviews  as $review )
         <tr>
          <td>{{$loop->index+1}}</td>
          <td>
            <img src="{{asset('backend/images/review/'.$review->image)}}" height="100" width="100">
          </td>
          <td>{{$review->name}}</td>
          <td>{{$review->status??"Not Found"}}</td>
          <td>{{$review->product->name}}</td>
          <td>{{$review->rating}}</td>
          <td>{!!$review->comments!!}</td>
          <td>
           <a href="{{url('/admin/edit-review/'.$review->id)}}" class="btn btn-primary">Edit</a>
           <a href="{{url('/admin/deete-review/'.$review->id)}}" class="btn btn-danger">Delete</a>
          </td>

        </tr>
         @endforeach
   
        </tbody>
     
      </table>
    </div>
    <!-- /.card-body -->

  </div>

@endsection
@push('js')
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>  
@endpush