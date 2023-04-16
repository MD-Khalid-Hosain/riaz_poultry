<?php

namespace App\Http\Controllers\Dashboard;

use App\CustomerDuePaid;
use App\CustomerOrder;
use App\Order;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function OrderSearch(){
        return view('backend.layouts.report.search_order');
    }
    public  function dueCollectionSearch(){
        return view('backend.layouts.report.due_collection.searchDueCollection');
    }

    public function orderReport(Request $request){
        if($request->order_date){
            $date = $request->order_date;
            $allOrders = CustomerOrder::whereDate('created_at', date($date))->get();
            $sum = CustomerOrder::whereDate('created_at', date($date))->sum('total');
            return view('backend.layouts.report.allOrders', compact('allOrders', 'sum', 'date'));
        }
        else if($request->order_month && $request->order_year){
            $month = $request->order_month;
            $year = $request->order_year;
            $allOrders = CustomerOrder::where('month', $month)->where('year', $year)->get();
            $sum = CustomerOrder::where('month', $month)->where('year', $year)->sum('total');
            return view('backend.layouts.report.allOrders', compact('allOrders', 'sum', 'month', 'year'));
        }
        else if($request->from && $request->to){
            $from = $request->from;
            $to = $request->to;
            $allOrders = CustomerOrder::whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->get();
            $allId = CustomerOrder::whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->pluck('id');

            $order = CustomerOrder::whereIn('id', $allId)->get();

            // $allOrders = Order::where('status', 'Delivered')->where('created_at', '>=', $from)->where('created_at', '<=', $to)->get();
            // $sum = Order::where('status', 'Delivered')->whereBetween('created_at', [date($from),date($to)])->sum('amount');
            $sum = CustomerOrder::whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->sum('total');
            // echo "<pre>";
            // print_r($sum); die;
            // echo "<pre>";
            return view('backend.layouts.report.allOrders', compact('allOrders', 'from', 'to','sum'));
        }
        else{
            $year = $request->order_year;
            $allOrders = CustomerOrder::where('year', $year)->get();
            $sum = CustomerOrder::where('year', $year)->sum('total');
            return view('backend.layouts.report.allOrders', compact('allOrders', 'sum', 'year'));
        }

    }

    public function dueCollectionReport(Request $request){
        if($request->order_date){
            $date = $request->order_date;
            $allOrders = CustomerDuePaid::whereDate('created_at', date($date))->get();
            $sum = CustomerDuePaid::whereDate('created_at', date($date))->sum('paid_due');
            return view('backend.layouts.report.due_collection.allDueCollection', compact('allOrders', 'sum', 'date'));
        }
        else if($request->order_month && $request->order_year){
            $month = $request->order_month;
            $year = $request->order_year;
            $allOrders = CustomerDuePaid::where('month', $month)->where('year', $year)->get();
            $sum = CustomerDuePaid::where('month', $month)->where('year', $year)->sum('paid_due');
            return view('backend.layouts.report.due_collection.allDueCollection', compact('allOrders', 'sum', 'month', 'year'));
        }
        else if($request->from && $request->to){
            $from = $request->from;
            $to = $request->to;
            $allOrders = CustomerDuePaid::whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->get();
            $allId = CustomerDuePaid::whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->pluck('id');

            $order = CustomerDuePaid::whereIn('id', $allId)->get();

            // $allOrders = Order::where('status', 'Delivered')->where('created_at', '>=', $from)->where('created_at', '<=', $to)->get();
            // $sum = Order::where('status', 'Delivered')->whereBetween('created_at', [date($from),date($to)])->sum('amount');
            $sum = CustomerDuePaid::whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->sum('paid_due');
            // echo "<pre>";
            // print_r($sum); die;
            // echo "<pre>";
            return view('backend.layouts.report.due_collection.allDueCollection', compact('allOrders', 'from', 'to','sum'));
        }
        else{
            $year = $request->order_year;
            $allOrders = CustomerDuePaid::where('year', $year)->get();
            $sum = CustomerDuePaid::where('year', $year)->sum('paid_due');
            return view('backend.layouts.report.due_collection.allDueCollection', compact('allOrders', 'sum', 'year'));
        }

    }

    public function reportDownload(Request $request){

        if($request->date){
            $date = $request->date;
            $sellReport = CustomerOrder::whereDate('created_at', date($date))->get();
            $total = CustomerOrder::whereDate('created_at', date($date))->sum('total');

            $report_pdf = PDF::loadView('backend.layouts.report.pdfDownload', compact('sellReport','total','date'));

            return $report_pdf->download('sellreport.pdf');

        }
        else if($request->month && $request->year){
            $month = $request->month;
            $year = $request->year;
            $sellReport = CustomerOrder::where('month', $month)->where('year', $year)->get();
            $total = CustomerOrder::where('month', $month)->where('year', $year)->sum('total');

            $report_pdf = PDF::loadView('backend.layouts.report.pdfDownload', compact('sellReport','total','year','month'));

            return $report_pdf->download('sellreport.pdf');
        }
        else if($request->from && $request->to){
            $from = $request->from;
            $to = $request->to;
            $sellReport = CustomerOrder::whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->get();

            $total = CustomerOrder::whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->sum('total');

            $report_pdf = PDF::loadView('backend.layouts.report.pdfDownload', compact('sellReport','total','from','to'));

            return $report_pdf->download('sellreport.pdf');
        }
        else{
            $year = $request->year;
            $sellReport = CustomerOrder::where('year', $year)->get();
            $total = CustomerOrder::where('year', $year)->sum('total');

            $report_pdf = PDF::loadView('backend.layouts.report.pdfDownload', compact('sellReport','total','year'));

            return $report_pdf->download('sellreport.pdf');
        }
    }

    public function dueCollectionReportDownload(Request $request){

        if($request->date){
            $date = $request->date;
            $sellReport = CustomerDuePaid::whereDate('created_at', date($date))->get();
            $total = CustomerDuePaid::whereDate('created_at', date($date))->sum('paid_due');

            $report_pdf = PDF::loadView('backend.layouts.report.due_collection.dueCollectionPdfDownload', compact('sellReport','total','date'));

            return $report_pdf->download('collectionReport.pdf');

        }
        else if($request->month && $request->year){
            $month = $request->month;
            $year = $request->year;
            $sellReport = CustomerDuePaid::where('month', $month)->where('year', $year)->get();
            $total = CustomerDuePaid::where('month', $month)->where('year', $year)->sum('paid_due');

            $report_pdf = PDF::loadView('backend.layouts.report.due_collection.dueCollectionPdfDownload', compact('sellReport','total','year','month'));

            return $report_pdf->download('collectionReport.pdf');
        }
        else if($request->from && $request->to){
            $from = $request->from;
            $to = $request->to;
            $sellReport = CustomerDuePaid::whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->get();

            $total = CustomerDuePaid::whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->sum('paid_due');

            $report_pdf = PDF::loadView('backend.layouts.report.due_collection.dueCollectionPdfDownload', compact('sellReport','total','from','to'));

            return $report_pdf->download('collectionReport.pdf');
        }
        else{
            $year = $request->year;
            $sellReport = CustomerDuePaid::where('year', $year)->get();
            $total = CustomerDuePaid::where('year', $year)->sum('paid_due');

            $report_pdf = PDF::loadView('backend.layouts.report.due_collection.dueCollectionPdfDownload', compact('sellReport','total','year'));

            return $report_pdf->download('collectionReport.pdf');
        }
    }
}
