@extends('backend.includes.master')
@section('content')
<div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <form action="{{url('/admin/site-setting/update')}}" method="post" enctype="multipart/form-data" class="form-control">
        @csrf
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Site Settings</h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Phone*</label>
                        <input type="text" name="phone" value="{{$sitesettings->phone}}" class="form-control"
                            placeholder="Enter phone number*" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Email*</label>
                        <input type="email" name="email" value="{{$sitesettings->email}}" class="form-control"
                            placeholder="Enter email*" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Address</label>
                        <textarea id="summernote" name="address" required>{{$sitesettings->address}}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Facebook(Optional)*</label>
                        <input type="text" name="facebook" value="{{$sitesettings->facebook}}" class="form-control"
                            placeholder="Enter facebook*">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Twitter(Optional)*</label>
                        <input type="text" name="twitter" value="{{$sitesettings->twitter}}" class="form-control"
                            placeholder="Enter twitter*">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Instagram(Optional)*</label>
                        <input type="text" name="instagram" value="{{$sitesettings->instagram}}" class="form-control"
                            placeholder="Enter instagram*">
                    </div>
                </div>

               

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Youtube(Optional)*</label>
                        <input type="text" name="youtube" value="{{$sitesettings->youtube}}" class="form-control"
                            placeholder="Enter youtube*">
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="form-group">
                        <label>Home Banner</label>
                        <input type="file" accept="image\*" name="banner" value="" class="form-control">

                    </div>

                   <img src="{{asset('backend/images/settings/'.$sitesettings->banner)}}" height="200" width="300">
                </div>


                <div class="col-md-12">
                    <div class="form-group">
                        <label>Logo</label>
                        <input type="file" accept="image\*" name="logo" value="" class="form-control">

                    </div>

                   <img src="{{asset('backend/images/settings/'.$sitesettings->logo)}}" height="60" width="150">
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