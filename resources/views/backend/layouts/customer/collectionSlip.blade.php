<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $customerPaid->due_given_id }}</title>
    <style media="screen">
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }
        a {
            color: #5D6975;
            text-decoration: underline;
        }
        body {
            position: relative;
            width: 18cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: DejaVu Sans;
            font-size: 12px;
        }
        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }
        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        h1 {
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }
        #project {
            float: left;
        }
        #project span {
            color: #5D6975;
            text-align: left;
            width: 70px;
            margin-right: 20px;
            display: inline-block;
            font-size: 0.8em;
        }
        #project div{
            white-space: nowrap;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 10px;
        }
        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }
        table th,
        table td {
            text-align: center;
        }
        table th {
            padding: 5px;
            color: #5D6975;
            border: 1px solid #5D6975;
            white-space: nowrap;
            font-weight: normal;
        }
        table .service,
        table .desc {
            text-align: left;
        }
        table td {
            padding: 20px;
            text-align: right;
            border: 1px solid #5D6975;
        }
        table td.service,
        table td.desc {
            vertical-align: top;
        }
        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
            border: 1px solid #5D6975;
        }
        table td.grand {
            border-top: 1px solid #5D6975;;
        }
        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }
        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>
<body>

{{--     <a href="{{ url('/') }}" target="_blank"><img src="{{ asset('frontend/assets/images/logo/original.png') }}" alt=""></a>--}}

<header class="clearfix">
    <h1>USHA POULTRY FEED </h1>
    <div id="logo">
        {{-- <img src="{{ asset('frontend/assets/images/logo/original.png') }}"> --}}
        <pre>Shop# Khalpar Road,Kacha Bazar Bhola Sadar Upazila, Bhola
              Call: 01711053755</pre>
    </div>

    <div id="project">
        <div><span>Order No.</span> {{ $customerPaid->due_given_id }}</div>
        <div><span>Client</span> {{ $customerPaid->customer->customer_name }}</div>
        <div><span>Address</span> {{ $customerPaid->customer->customer_address }}</div>
        <div><span>Mobile</span>{{ $customerPaid->customer->customer_number }}</div>
        <div><span>Date</span>{{ $customerPaid->created_at->translatedFormat('d, F, Y') }}</div>
    </div>
</header>
<main>
    <table>
        <thead>
        <tr>
            <th class="service">Due Before Paid</th>
            <th class="service">Today Paid</th>
            <th class="service">Remaining Due</th>
        </tr>
        </thead>
        <tbody>

            <tr>
                <td class="service">{{ $customerPaid->due_before_paid }} Tk</td>
                <td class="service">{{ $customerPaid->paid_due }} Tk</td>
                <td class="service">{{ $customerPaid->due_after_paid }} Tk</td>
            </tr>

        </tbody>
    </table>

    <div id="notices">
        <div>Notice: </div>
        <div class="notice">** Paid ID is very important</div>
    </div>
</main>
<footer>
    Invoice was created on a computer and is valid without the signature and seal.
</footer>
</body>
</html>
