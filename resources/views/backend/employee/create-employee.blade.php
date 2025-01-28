@extends('backend.includes.master')
@section('content')
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <form action="{{ url('/admin/store-employees') }}" method="post" enctype="multipart/form-data" class="form-control">
            @csrf
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Add New Employee</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Employee name*</label>
                                <input type="name" name="name" value="" class="form-control"
                                    placeholder="Enter employee name*" required>

                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email*</label>
                                <input type="email" name="email" value="" class="form-control"
                                    placeholder="Enter employee email*" required>

                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Password*</label>
                                <input type="text" name="password" value="" class="form-control"
                                    placeholder="Enter employee password*" required>

                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Employee Role*</label>
                                <select name="role"selected class="form-control">
                                    <option value="employee" selected>employee</option>
                                    <option value="admin">admin</option>
                                    <option value="editor">editor</option>
                                </select>
                            </div>

                        </div>


                        <div class="col-md-12">
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


