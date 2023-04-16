@extends('backend.master')
@section('title')
    Vendor Edit
@endsection

@section('vendor_active')
    active open
@endsection
@section('vendor_toggled')
    toggled waves-effect waves-block
@endsection

@section('content')
    <div class="body_scroll">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Edit Vendor</strong></h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('vendors.update',$vendor->id) }}" method="POST" enctype="multipart/form-data" id="updatPwdForm">
                                {{ method_field('PUT') }}
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label for="vendor_name">Vendor Name</label><span class="required">*</span>
                                            <div class="form-group">
                                                <input type="text" id="vendor_name" name="name" value="{{$vendor->name}}" class="form-control" placeholder="Type Vendor Name">
                                                @error ('name')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label for="vendor_number">Vendor Mobile Number</label><span class="required">*</span>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="number" id="vendor_number" value="{{$vendor->number}}" placeholder="01xxxxxxxxx">
                                                @error ('number')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label for="vendor_address">Vendor Address</label><span class="required">*</span>
                                            <div class="form-group">
                                                <textarea name="address" id="vendor_address" class="form-control" cols="60" rows="5">{{$vendor->address}}</textarea>
                                                @error ('address')
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
