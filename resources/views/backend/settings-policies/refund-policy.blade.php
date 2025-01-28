@extends('backend.includes.master')
@section('content')
<div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <form action="{{url('/admin/update/refund-policy')}}" method="post" enctype="multipart/form-data" class="form-control">
        @csrf
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Refund Policy</h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Refund Policy Content*</label>
                        <textarea id="summernote" name="refund_policy" required>{{$policy->refund_policy}}</textarea>
                    </div>
                </div>

                <div class="col-md-12 mt-3">
                    <div class="form-group">
                    
                        <input type="submit" value="submit" class="form-control btn btn-info">

                    </div>

                </div>

               

            </div>

        </div>
    </div>
</form>
</div>
@endsection

@push('js')
<script>

    $(function () {
      // Summernote
      $('#summernote').summernote()
  
      // CodeMirror
      CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
        mode: "htmlmixed",
        theme: "monokai"
      });
    })
  </script> 
@endpush