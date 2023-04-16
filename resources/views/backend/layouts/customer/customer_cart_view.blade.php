@extends('backend.master')
@section('title')
    view Order
@endsection
@section('customer_active')
    active open
@endsection
@section('customer_toggled')
    toggled waves-effect waves-block
@endsection
@section('header_section')

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />
@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Cart View</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Aero</a></li>
                        <li class="breadcrumb-item active">Pages</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible" >
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible" >
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <form action="{{route('update-customer-cart')}}" method="post">
                                    @csrf

                                    <table class="table table-hover c_table theme-color">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th class="hidden-sm-down">Unit Cost</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($customerCartProducts as $orderItem)
                                            <input type="hidden" name="cart_id[]" value="{{$orderItem->id}}">
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ App\FeedProduct::where('id',$orderItem->product_id)->value('f_product_name') }}</td>
                                                <td> <input type="number" value="{{ $orderItem->product_quantity }}" name="product_quantity[]"> {{ App\FeedProduct::where('id',$orderItem->product_id)->value('unit_type') }}</td>
                                                <td class="hidden-sm-down">৳ {{ $orderItem->price }}</td>
                                                <td>৳ {{ $orderItem->price * $orderItem->product_quantity }}</td>
                                                <td><a href="{{route('cart-item-delete', $orderItem->id)}}" class="btn btn-default waves-effect waves-float btn-sm waves-red"><i class="zmdi zmdi-delete"></i></a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <button class="btn btn-primary mb-3" type="submit"><i class="zmdi zmdi-check-square mr-2"></i>Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <form action="{{route('customer-order-checkout')}}" method="post">
                            @csrf
                        <div class="body">
                            <div class="row">
                                    <div class="col-md-6">
                                        <label for="product_description">Customer Paid</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="customer_paid" class="form-control" id="customer_paid">
                                            @error ('customer_paid')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="product_description">Customer Due</label><span class="required">*</span>
                                            <input type="text" name="customer_due" id="customer_due" class="form-control" readonly>
                                        </div>
                                    </div>
                                <div class="col-md-6">
                                    <h5>Note</h5>
                                    <p>Products once sold can not be replaced or returned. Thanks for being with us.</p>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-unstyled">
                                        <li><strong>Sub-Total:-</strong>৳ {{ $total_price }}</li>
                                        <input type="hidden" id="total" name="total" value="{{ $total_price }}">
                                    </ul>
                                    <button type="submit" class="btn btn-info"><i class="zmdi zmdi-check-square mr-2"></i>Checkout</button>
                                </div>

                            </div>
                        </div>
                            <input type="hidden" name="customer_id" value="{{$customerId}}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_section')
    <script>
        $("#customer_paid").keyup(function(){
            let customer_paid = $(this).val();
            let total = $("#total").val();
            let finalTotal = total - customer_paid;

            $("#customer_due").val(finalTotal);
        });
    </script>
@endsection
