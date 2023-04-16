<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
<style>
table {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid black;
}
.total{
    text-align: right;

}
.center{
    display: inline-block;
    text-align: center;
    padding-bottom: 0;
    margin-bottom:0;
}
.left{
    display: inline-block;
    margin-bottom: 50px;
}
.khalid{
    padding: 50px;
}

th, td {
  text-align: left;
  padding: 8px;
  border: 1px solid black;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #2A2F8C;
  color: white;
  border: 1px solid black;
}
</style>
</head>
<body>

<div class="center">
    <h2>Usha Poultry Feed</h2>
<p>
    Shop# Khalpar Road,Kacha Bazar
    , Bhola Sadar Upazila, Bhola
    Call: 01711053755
</p>
</div>
<h2> All Collection of @isset($date) {{ $date }} and Total Collection = {{ number_format($total)}}Tk  @else @isset($month) {{ $month }}, {{ $year }} and Total Collection = {{ number_format($total)}}Tk @else @isset($from) {{ $from }} to {{ $to }} and Total Collection = {{ number_format($total)}}Tk @else Year-{{ $year }} and Total Collection = {{ number_format($total)}}Tk   @endisset @endisset @endisset</h2>

<table>
  <tr>
    <th>Paid ID</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Due</th>
    <th>Today Paid</th>
    <th>Remaining Due</th>
  </tr>

@foreach ($sellReport as $order)
    <tr>
        <td>{{ $order->due_given_id }}</td>
        <td>{{ $order->customer->customer_name }}</td>
        <td>{{ $order->customer->customer_number}}</td>
        <td>{{ $order->due_before_paid}} Tk</td>
        <td>{{ $order->paid_due}} Tk</td>
        <td>{{ $order->due_after_paid}} Tk</td>
    </tr>
@endforeach
<tr>
    <td class="total" colspan="4">Total</td>
    <td>{{ $total }} Tk</td>
    <td></td>
</tr>

</table>

</body>
</html>
