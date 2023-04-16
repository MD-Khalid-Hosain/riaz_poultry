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
                    <h2>Feed Product Create</h2>
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
                            <h2><strong>Add Feed Products</strong></h2>
                        </div>
                        <div class="body">
                            <form name="feedProductForm" id="feedProductForm" action="{{route('feed-products.update', $product->id)}}"  method="POST" enctype="multipart/form-data">
                                {{ method_field('PUT') }}
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="product_name">Product Name</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="f_product_name" class="form-control" id="f_product_name" value="{{ $product->f_product_name }}">
                                            @error ('f_product_name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="brand_id">Select Brnad</label><span class="required">*</span>
                                        <div class="form-group" style="text-align:center">
                                            <select name="brand_id" id="brand_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                                <option value="">--Select Brand--</option>
                                                @foreach ($brands as $brandDetails)
                                                    <option  @if($product->brand_id == $brandDetails['id']) selected @endif value="{{ $brandDetails['id'] }}">{{ $brandDetails['name'] }}</option>
                                                @endforeach
                                            </select>
                                            @error ('brand_id')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="product_description">Product Description</label><span class="required">*</span>
                                        <div class="form-group">
                                            <textarea name="description"  class="form-control"  rows="9">{{ $product->description }}</textarea>
                                            @error ('description')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="slug">Slug</label><span class="required">*</span>
                                        <div class="form-group" style="text-align:center">
                                            <input type="text" name="slug" class="form-control" placeholder="slug" id="slug" value="{{ $product->slug}}">
                                            @error ('slug')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <label for="unit_type">Select Unit Type</label><span class="required">*</span>
                                        <div class="form-group" style="text-align:center">
                                            <select name="unit_type" id="unit_type" class="form-control show-tick ms select2" data-placeholder="Select">
                                                <option value="">--Select Unit Type--</option>
                                                <option @if($product->unit_type == 'KG') selected @endif value="KG">KG</option>
                                                <option @if($product->unit_type == 'Packet') selected @endif value="Packet">Packet</option>
                                                <option @if($product->unit_type == 'Bottle') selected @endif value="Bottle">Bottle</option>
                                                <option value="Bottle">Bottle</option>
                                            </select>
                                            @error ('unit_type')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Update</button>
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
        $("#f_product_name").keyup(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
            $("#slug").val(Text);
        });
    </script>
@endsection
