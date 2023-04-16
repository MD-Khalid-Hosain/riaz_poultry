<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



//total earn money

function totalEarning(){
    $allOrder = App\CustomerOrder::select('total')->get();
    $total = 0;
    foreach($allOrder as $order){
        $total = $total + $order->total;
    }

    return $total;
}
function totalDue(){
    $totalDue = App\Customer::get();
    $total = 0;
    foreach($totalDue as $due){
        $total = $total + $due->customer_due;
    }

    return $total;
}

//this month earn money
function thisMonthSell(){
    $sellThisMonth = App\CustomerOrder::whereMonth('created_at', Carbon::now()->month)->get();
    $total = 0;
    foreach($sellThisMonth as $order){
        $total = $total + $order->total;
    }
    return $total;
}
//this month due
function thisMonthDue(){
    $totalDueThisMonth = App\CustomerOrder::select('cus_due')->whereMonth('created_at', Carbon::now()->month)->get();
    $total = 0;
    foreach($totalDueThisMonth as $due){
        $total = $total + $due->cus_due;
    }

    return $total;
}
//this month collection
function thisMonthCollection(){
    $totalDueCollectionThisMonth = App\CustomerDuePaid::select('paid_due')->whereMonth('created_at', Carbon::now()->month)->get();
    $total = 0;
    foreach($totalDueCollectionThisMonth as $due){
        $total = $total + $due->paid_due;
    }

    return $total;
}
//this month paid
function thisMonthPaid(){
    $thisMonthPaid = App\CustomerOrder::select('cus_paid')->whereMonth('created_at', Carbon::now()->month)->get();
    $total = 0;
    foreach($thisMonthPaid as $due){
        $total = $total + $due->cus_paid;
    }
    return $total;
}
//Last Month sell
function lastMonthSell(){
    $allOrder = App\CustomerOrder::select('total')->whereMonth('created_at', Carbon::now()->subMonthNoOverflow()->month)->get();
    $total = 0;
    foreach($allOrder as $order){
        $total += $order->total;
    }

    return $total;
}
//Last Month total due
function lastMonthTotalDue(){
    $allOrder = App\CustomerOrder::select('cus_due')->whereMonth('created_at', Carbon::now()->subMonthNoOverflow()->month)->get();
    $total = 0;
    foreach($allOrder as $order){
        $total += $order->total;
    }

    return $total;
}
//last month collection
function lastMonthCollection(){
    $totalDueCollectionLastMonth = App\CustomerDuePaid::select('paid_due')->whereMonth('created_at', Carbon::now()->subMonthNoOverflow()->month)->get();
    $total = 0;
    foreach($totalDueCollectionLastMonth as $due){
        $total = $total + $due->paid_due;
    }
    return $total;
}
//this month paid
function lastMonthPaid(){
    $lastMonthPaid = App\CustomerOrder::select('cus_paid')->whereMonth('created_at', Carbon::now()->subMonthNoOverflow()->month)->get();
    $total = 0;
    foreach($lastMonthPaid as $due){
        $total = $total + $due->cus_paid;
    }
    return $total;
}
