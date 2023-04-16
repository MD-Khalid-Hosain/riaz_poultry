@extends('backend.master')
@section('title')
    Sales Report
@endsection
@section('order_settings_active')
    active open
@endsection
@section('report_active')
    active
@endsection
@section('report_toggled')
    toggled waves-effect waves-block
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2> All Collection of @isset($date) {{ $date }} and Total Collection = {{ number_format($sum)}}Tk  @else @isset($month) {{ $month }}, {{ $year }} and Total Collection= {{ number_format($sum)}}Tk @else @isset($from) {{ $from }} to {{ $to }} and Total Collection = {{ number_format($sum)}}Tk @else Year-{{ $year }} and Total Collection = {{ number_format($sum)}}Tk   @endisset @endisset @endisset</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>

                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
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
                    <form action="{{ route('due-collection-download.report') }}" method="POST">
                        @csrf
                        @isset($date)
                            <input type="hidden" name="date" value="{{ $date }}">
                            <button class="btn btn-primary " type="submit">Download</button>
                        @else
                            @isset($month)
                                <input type="hidden" name="month" value="{{ $month }}">
                                <input type="hidden" name="year" value="{{ $year }}">
                                <button class="btn btn-primary " type="submit">Download</button>
                            @else @isset($from)
                                <input type="hidden" name="from" value="{{ $from }}">
                                <input type="hidden" name="to" value="{{ $to }}">
                                <button class="btn btn-primary " type="submit">Download</button>
                            @else
                                <input type="hidden" name="year" value="{{ $year }}">
                                <button class="btn btn-primary " type="submit">Download</button>
                            @endisset @endisset @endisset
                    </form>
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover  dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Paid ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Due</th>
                                        <th>Paid Today</th>
                                        <th>Remaining Due</th>
                                        <th>Paid Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($allOrders as $order)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $order->due_given_id }}</td>
                                            <td>{{ $order->customer->customer_name }}</td>
                                            <td>{{ $order->customer->customer_number}}</td>
                                            <td>{{ $order->due_before_paid}} Tk</td>
                                            <td>{{ $order->paid_due}} Tk</td>
                                            <td>{{ $order->due_after_paid}} Tk</td>
                                            <td>{{ $order->created_at->format('d/m/Y')}}</td>
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
