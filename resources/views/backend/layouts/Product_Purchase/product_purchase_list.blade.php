@extends('backend.master')
@section('title')
    Feed Product List
@endsection

@section('feed_product_settings_active')
    active open
@endsection
@section('purchase_active')
    active
@endsection
@section('purchase_toggled')
    toggled waves-effect waves-block
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Purchase Product List</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Normal Tables</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Exportable Table -->
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
                    <div class="card">
                        <div class="header">
                            <h2><strong>Purchase Product</strong> List </h2>
                            <a href="{{route('product-purchase.create')}}" class="btn btn-labeled btn-info float-right my-3">
                                <span class="btn-label"><i class="zmdi zmdi-plus font-weight-bold pr-2"></i></span>Purchase Product</a>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover  dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Purchase ID</th>
                                        <th>Product Name</th>
                                        <th>Vendor</th>
                                        <th>SKU</th>
                                        <th>Unit Price</th>
                                        <th>Total</th>
                                        <th>Purchase Date</th>
                                        <th>Ago</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($productPurchases as $purchases)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $purchases->purchase_id }}</td>
                                            <td>{{ $purchases->product->f_product_name }}</td>
                                            <td>{{ $purchases->vendor->name}}</td>
                                            <td>{{ $purchases->quantity}} {{$purchases->product->unit_type}}</td>
                                            <td>{{ $purchases->unit_price}} Tk</td>
                                            <td>{{ $purchases->total}} Tk</td>
                                            <td>
                                                @if (isset($purchases->created_at))
                                                    {{ $purchases->created_at->format('d/m/Y') }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($purchases->created_at))
                                                    {{ $purchases->created_at->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_section')
    <script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('backend/assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/tables/jquery-datatable.js') }}"></script>

@endsection
