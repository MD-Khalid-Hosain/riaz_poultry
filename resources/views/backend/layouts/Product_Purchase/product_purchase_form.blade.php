@extends('backend.master')
@section('feed_product_settings_active')
    active open
@endsection
@section('feed_product_active')
    active
@endsection
@section('feed_product_toggled')
    toggled waves-effect waves-block
@endsection
@section('header_section')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />
    <!-- Bootstrap Tagsinput Css -->
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/summernote/dist/summernote.css') }}"/>

@endsection
@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Product Purchase</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Aero</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Form Examples</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
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
                            <h2><strong>Product Purchase</strong></h2>
                        </div>
                        <div class="body">
                            <form name="productPurchase" id="productPurchase" action="{{route('product-purchase.store')}}"  method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="product_id">Select Product</label><span class="required">*</span>
                                        <div class="form-group" style="text-align:center">
                                            <select name="product_id" id="product_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                                <option value="">--Select Product--</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->f_product_name }}</option>
                                                @endforeach
                                            </select>
                                            @error ('product_id')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="vendor_id">Select Vendor</label><span class="required">*</span>
                                        <div class="form-group" style="text-align:center">
                                            <select name="vendor_id" id="vendor_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                                <option value="">--Select Vendor--</option>
                                                @foreach ($vendors as $vendor)
                                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                                @endforeach
                                            </select>
                                            @error ('vendor_id')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="quantity">Product Unit</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="quantity" class="form-control" placeholder="product unit / quantity" id="quantity" value="{{ old('quantity') }}">
                                            @error ('quantity')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="total">Total</label>
                                        <div class="form-group">
                                            <input type="text" name="total" class="form-control" disabled  id="total" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="unit_price">Unit Price</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="unit_price" class="form-control" placeholder="unit price" id="unit_price" value="{{ old('unit_price') }}">
                                            @error ('unit_price')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_section')
    <script src="{{ asset('backend/assets/plugins/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
    <script src="{{ asset('backend/assets/js/pages/forms/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/forms/editors.js') }}"></script>
    <script>
        $("#unit_price").keyup(function(){
            let unit_price = $(this).val();
            let quantity = $("#quantity").val();
            let total = unit_price * quantity;

            $("#total").val(total);
        });
    </script>
@endsection
