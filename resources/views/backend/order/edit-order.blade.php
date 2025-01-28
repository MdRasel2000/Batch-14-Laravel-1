@extends('backend.includes.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Order</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ url('/admin/order/update/'. $order->id) }}" method="post" enctype="multipart/form-data"
                class="form-control">
                @csrf
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Edit Order</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Invoiced Id</label>
                                        <input type="text" name="invoiceId" value="{{ $order->invoiceId }}"
                                            class="form-control" readonly>

                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <input type="text" name="c_name" value="{{ $order->c_name }}"
                                            class="form-control" required>

                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Customer Phone</label>
                                        <input type="text" name="c_phone" value="{{ $order->c_phone }}"
                                            class="form-control" required>

                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Customer Address</label>
                                        <textarea name="address" class="form-control">{{ $order->address }}</textarea>

                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Delivery Charge</label>
                                        <input type="text" name="area" value="{{ $order->area }}"
                                            class="form-control" required>

                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Courier Name</label>
                                        <select name="courier_name" class="form-control" required>
                                            <option value="steadfast" @if ($order->courier_name == 'steadfast')
                                                selected
                                            @endif>Steadfast</option>
                                            <option value="redex" @if ($order->courier_name == 'redex')
                                                selected
                                            @endif>Redex</option>
                                            <option value="others" @if ($order->courier_name == 'others')
                                                selected
                                            @endif>Others</option>
                                        </select>
                                    </div>

                                </div>

                            </div>

                             <div class="col-6">

                                @foreach ($order->orderDetails as $details)
                                <td>
                                    <img src="{{ asset('backend/images/product/' . $details->product->image) }}" height="100" width="100">
                                    {{ $details->qty }} x {{ $details->product->name }} <br> <br>

                                </td>
                            @endforeach

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" name="price" value="{{ $order->price}}"
                                        class="form-control" required>

                                </div>

                            </div>

                             </div>

                            <div class="col-md-12">
                                <div class="form-group">

                                    <input type="submit" value="Update" class="form-control btn btn-info">

                                </div>

                            </div>


                        </div>

                    </div>
                </div>
            </form>

        </div>
        <!-- /.card-body -->

    </div>
@endsection
