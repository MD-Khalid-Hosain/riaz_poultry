@extends('backend.master')
@section('title')
    Customer Order
@endsection

@section('customer_active')
    active open
@endsection
@section('customer_toggled')
    toggled waves-effect waves-block
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Products</h2>
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
                            <strong>{{ session('success') }} successfully added in cart</strong>
                            <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('error_msg'))
                        <div class="alert alert-danger alert-dismissible" >
                            <strong>{{ session('error_msg') }}</strong>
                            <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="header">
                            <h2><strong>Product</strong> List </h2>
                            <a href="{{route('view-customer-cart', $customer_id)}}" class="btn btn-labeled btn-info float-right my-3">
                                <span class="btn-label"><i class="zmdi zmdi-eye  mr-2"></i></span>View Cart</a>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover  dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Product Name</th>
                                        <th>Details</th>
                                        <th>Brand</th>
                                        <th>SKU</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Add</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($feedProducts as $product)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $product->f_product_name }}</td>
                                            <td>{{ substr(strip_tags($product->description), 0, 30) }}{{ strlen(strip_tags($product->description)) > 30 ? "....": "" }} </td>
                                            <td>{{ $product->brand->name}}</td>
                                            <td>
                                                @if ($product->sku >= 10)
                                                    <span class="badge badge-success w-bold">{{ $product->sku }} {{ $product->unit_type }}</span>
                                                @else
                                                    @if ($product->sku <= 5)
                                                        <span class="badge badge-danger w-bold">{{ $product->sku }} {{ $product->unit_type }}</span>
                                                    @else
                                                        @if ($product->sku < 10)
                                                            <span class="badge bg-warning text-dark w-bold">{{ $product->sku }} {{ $product->unit_type }}</span>
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>
                                            <form action="{{ route('add-to-customer-cart') }}" method="POST">
                                                @csrf
                                            <td>
                                                <input type="hidden"  name="customer_id" value="{{$customer_id}}">
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="number" name="product_quantity">
                                                @error ('product_quantity')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </td>
                                                <td>
                                                    <input type="number" name="price">
                                                    @error ('price')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary btn-sm"><i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></button>
                                            </td>
                                            </form>
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
