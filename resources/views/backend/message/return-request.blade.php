@extends('backend.includes.master')
@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Rrturn Request Message List</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>SI</th>
          <th>Date</th>
          <th>Name</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Order ID</th>
          <th>Issue</th>
          <th>Images</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
         @foreach ($returnRequest as $return )
         <tr>
          <td>{{$loop->index+1}}</td>
          <td>{{$return->created_at}}</td>
          <td>{{$return->c_name}}</td>
          <td>{{$return->c_phone}}</td>
          <td>{{$return->address}}</td>
          <td>{{$return->order_id}}</td>
          <td>{{$return->issue}}</td>

          <td>
            <img src="{{asset('backend/images/return/'.$return->image)}}" height="100" width="100">
          </td>
          <td>
           <a href="{{url('/admin/delete-return-req-messages/'.$return->id)}}" onclick="return confirm('Are You Sure')" class="btn btn-danger">Delete</a>
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