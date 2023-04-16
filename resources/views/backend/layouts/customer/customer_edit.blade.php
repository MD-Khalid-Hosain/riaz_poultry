@extends('backend.master')
@section('title')
    Feed Product List
@endsection

@section('customer_active')
    active open
@endsection
@section('customer_toggled')
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
                            <h2><strong>Edit Customer</strong></h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('customer.update',$customer->id) }}" method="POST" enctype="multipart/form-data" id="updatPwdForm">
                                {{ method_field('PUT') }}
                                @csrf
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="customer_name">Customer Name</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" id="customer_name" name="customer_name"  value="{{$customer->customer_name}}" class="form-control">
                                            @error ('customer_name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="customer_number">Customer Mobile Number</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="customer_number" id="customer_number" value="{{$customer->customer_number}}" >
                                            @error ('customer_number')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="customer_address">Customer Address</label><span class="required">*</span>
                                        <div class="form-group">
                                            <textarea name="customer_address" id="customer_address" class="form-control" cols="60" rows="5">{{$customer->customer_address}}</textarea>
                                            @error ('customer_address')
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
