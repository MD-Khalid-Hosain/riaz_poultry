@extends('backend.master')
@section('title')
    view Order
@endsection
@section('customer_order_settings_active')
    active open
@endsection
@section('customer_order_active')
    active
@endsection
@section('customer_order_toggled')
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
                    <h2>Invoice</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Invoice</li>
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
                    <div class="card">
                        <div class="body">
                            <h5><strong>Order ID: </strong> #{{ $order_no->tran_id }}</h5>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <address>
                                        <strong>{{ $customer->customer_name }}</strong><br>
                                        <strong>Mobile: </strong>{{ $customer->customer_number }}<br>
                                        <strong>Address: </strong>{{ $customer->customer_address }}<br>
                                    </address>
                                </div>

                                <div class="col-md-6 col-sm-6 text-right">
                                    <p class="mb-0"><strong>Order Date: </strong> {{ $order_no->created_at->translatedFormat('d, F, Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover c_table theme-color">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th class="hidden-sm-down">Unit Cost</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $total_price=0;
                                        @endphp
                                        @foreach ($order_details as $orderItem)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ App\FeedProduct::where('id',$orderItem->product_id)->value('f_product_name') }}</td>
                                                <td>{{ $orderItem->quantity }}</td>
                                                <td class="hidden-sm-down">৳ {{ $orderItem->price }}</td>
                                                <td>৳ {{ $orderItem->price * $orderItem->quantity }}</td>
                                            </tr>
                                            @php
                                                $total_price += $orderItem->quantity * $orderItem->price;
                                            @endphp
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Note</h5>
                                    <p>Products once sold can not be replaced or returned. Thanks for being with us.</p>
                                </div>
                                <div class="col-md-2">

                                </div>
                                <div class="col-md-4 text-right">
                                    <ul class="list-unstyled">
                                        <li><strong>Sub-Total:-</strong>৳ {{ $total_price }}</li>
                                        <li><strong>Customer Paid:-</strong>৳ {{ $order_no->cus_paid }}</li>
                                        <li><strong>Customer Due:-</strong>৳ {{ $order_no->cus_due }}</li>
                                    </ul>
                                    <a href="{{ route('customer-pdfDownload-order',$order_no->id ) }}" target="_blank" class="btn btn-info"><i class="zmdi zmdi-print"></i></a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
