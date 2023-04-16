@extends('backend.master')
@section('dashboard_active')
active open
@endsection
@section('dashboard_toggled')
    toggled waves-effect waves-block
@endsection
@section('content')
     <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Overview Page</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <h2>This Month Overview</h2>
             <div class="row clearfix">
                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="body xl-green">
                            <h4 class="m-t-0 m-b-0">{{ number_format(totalEarning()) }} Tk</h4>
                            <p class="m-b-0 ">Total Sell</p>

                        </div>
                    </div>
                </div>
                 <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="body xl-khaki">
                            <h4 class="m-t-0 m-b-0">{{ number_format(totalDue()) }} Tk</h4>
                            <p class="m-b-0 ">Total Due</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="body xl-green">
                            <h4 class="m-t-0 m-b-0">{{ number_format(thisMonthDue()) }} Tk</h4>
                            <p class="m-b-0 ">{{ Carbon\Carbon::now()->format('F Y') }} Due</p>

                        </div>
                    </div>
                </div>
                 <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="body xl-green">
                            <h4 class="m-t-0 m-b-0">{{ number_format(thisMonthCollection()) }} Tk</h4>
                            <p class="m-b-0 ">{{ Carbon\Carbon::now()->format('F Y') }} Collection</p>

                        </div>
                    </div>
                </div>
                 <div class="col-lg-2 col-md-6">
                     <div class="card">
                         <div class="body xl-blue">
                             <h4 class="m-t-0 m-b-0">{{ thisMonthPaid() }} Tk</h4>
                             <p class="m-b-0">{{ Carbon\Carbon::now()->format('F Y') }} Paid</p>
                         </div>
                     </div>
                 </div>
                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="body xl-pink">
                            <h4 class="m-t-0 m-b-0">{{ number_format(thisMonthSell()) }} Tk</h4>
                            <p class="m-b-0">{{ Carbon\Carbon::now()->format('F Y') }} Sell</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="container-fluid">
             <h2>Previous Month Overview</h2>
             <div class="row clearfix">
                 <div class="col-lg-2 col-md-6">
                     <div class="card">
                         <div class="body xl-green">
                             <h4 class="m-t-0 m-b-0">{{ number_format(lastMonthSell()) }} Tk</h4>
                             <p class="m-b-0 ">Last Month Total Sell</p>

                         </div>
                     </div>
                 </div>
                 <div class="col-lg-2 col-md-6">
                     <div class="card">
                         <div class="body xl-green">
                             <h4 class="m-t-0 m-b-0">{{ number_format(lastMonthTotalDue()) }} Tk</h4>
                             <p class="m-b-0 ">Last Month Due</p>

                         </div>
                     </div>
                 </div>
                 <div class="col-lg-2 col-md-6">
                     <div class="card">
                         <div class="body xl-green">
                             <h4 class="m-t-0 m-b-0">{{ number_format(lastMonthCollection()) }} Tk</h4>
                             <p class="m-b-0 ">Last Month Collection</p>

                         </div>
                     </div>
                 </div>
                 <div class="col-lg-2 col-md-6">
                     <div class="card">
                         <div class="body xl-green">
                             <h4 class="m-t-0 m-b-0">{{ number_format(lastMonthPaid()) }} Tk</h4>
                             <p class="m-b-0 ">Last Month Paid</p>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
    </div>
@endsection
