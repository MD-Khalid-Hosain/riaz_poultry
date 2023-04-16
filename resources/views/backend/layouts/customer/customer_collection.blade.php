@extends('backend.master')
@section('header_section')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/dropify/css/dropify.min.css') }}">
@endsection
@section('title')
    Feed Product List
@endsection

@section('customer_due_active')
    active open
@endsection
@section('customer_due_toggled')
    toggled waves-effect waves-block
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Customer Due Collection</h2>

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
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible" >
                                    <strong>{{ session('error') }}</strong>
                                    <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible" >
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form action="{{ route('customer-due-paid') }}" method="POST" enctype="multipart/form-data" id="updatPwdForm">
                                @csrf
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label for="customer_id">Select Customer</label><span class="required">*</span>
                                            <select name="customer_id" id="customer_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                                <option value="">Select Customer</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->customer_name }}--{{ $customer->customer_number }}</option>
                                                @endforeach
                                            </select>
                                            @error ('customer_id')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="due_before_paid">Previous Total Due</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="due_before_paid" id="due_before_paid" readonly>
                                            @error ('due_before_paid')
                                            <small class="text-danger">{{  $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="today_pay">Today Pay</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="paid_due" id="today_pay" >
                                            @error ('paid_due')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="due_after_paid">Due Remain</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="due_after_paid" id="due_after_paid" readonly >
                                            @error ('due_after_paid')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Pay</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover  dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>ID</th>
                                        <th>Customer Name</th>
                                        <th>Number</th>
                                        <th>Previous Due</th>
                                        <th>Today Pay</th>
                                        <th>Remaining Due</th>
                                        <th>Total Paid</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($collectionList as $collection)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $collection->due_given_id}}</td>
                                            <td>{{ $collection->customer->customer_name }}</td>
                                            <td>{{ $collection->customer->customer_number }}</td>
                                            <td>{{ $collection->due_before_paid}} Tk</td>
                                            <td>{{ $collection->paid_due}} Tk</td>
                                            <td>{{ $collection->due_after_paid}} Tk</td>
                                            <td>{{ $collection->customer->customer_paid}} Tk</td>
                                            <td>
                                                <a href="{{ route('customer-collection-slip',$collection->id) }}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-download"></i></a>
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
    <script src="{{ asset('backend/assets/plugins/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
    <script src="{{ asset('backend/assets/js/pages/forms/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('backend/assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/tables/jquery-datatable.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#customer_id').change(function(){
                var customer_id = $(this).val();
                // ajaxSetup start
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                // ajaxSetup end
                // ajaxSetup request start
                $.ajax({
                    type: 'POST',
                    url: '/get/customer/total/due',
                    data:{customer_id:customer_id},
                    success:function(data){
                        $('#due_before_paid').val(data);
                    }
                });
                // ajaxSetup request end
            });

            $('#today_pay').keyup(function () {
                var today_pay = $(this).val();
                var previous_total_due = $('#due_before_paid').val();
                var remain_due = previous_total_due - today_pay;
                $('#due_after_paid').val(remain_due);
            })
        });
    </script>

@endsection
