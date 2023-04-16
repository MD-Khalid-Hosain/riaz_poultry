<?php

namespace App\Http\Controllers\Dashboard;

use App\Brand;
use App\FeedProduct;
use App\Http\Controllers\Controller;
use App\ProductPurchase;
use App\Vendors;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ProductPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productPurchases = ProductPurchase::orderBy('id', 'DESC')->get();
        return view('backend.layouts.Product_Purchase.product_purchase_list', compact('productPurchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendors::select('id', 'name')->get();
        $products = FeedProduct::select('id','f_product_name')->get();
        return view('backend.layouts.Product_Purchase.product_purchase_form', compact('vendors','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>'required',
            'quantity'=>'required',
            'unit_price'=>'required'
        ]);
        foreach (range(date('Y'), date('Y') + 10) as $y) {
            if ($y == date('Y')) {
                $allOrders = ProductPurchase::where('year', date('Y'))->get();
                $countOrder = count($allOrders) + 1;
                if ($countOrder < 10) {

                    $purchase_no = 'UPF-' . Carbon::now()->translatedFormat('Y') . '-' . '00000' . $countOrder ;
                    ; // tran_id must be unique
                } elseif ($countOrder >= 10 && $countOrder <= 99) {
                    $purchase_no = 'UPF-' . Carbon::now()->translatedFormat('Y') . '-' . '0000' . $countOrder ;
                    ; // tran_id must be unique
                } elseif ($countOrder >= 100 && $countOrder <= 999) {
                    $purchase_no= 'UPF-' . Carbon::now()->translatedFormat('Y') . '-' . '000' . $countOrder ;
                    ; // tran_id must be unique
                } elseif ($countOrder >= 1000 && $countOrder <= 9999) {
                    $purchase_no = 'UPF-' . Carbon::now()->translatedFormat('Y') . '-' . '00' . $countOrder ;
                    ; // tran_id must be unique
                } elseif ($countOrder >= 10000 && $countOrder <= 99999) {
                    $purchase_no = 'UPF-' . Carbon::now()->translatedFormat('Y') . '-' . '0' . $countOrder ;
                    ; // tran_id must be unique
                } elseif ($countOrder >= 100000) {
                    $purchase_no = 'UPF-' . Carbon::now()->translatedFormat('Y') . '-' . $countOrder ; // tran_id must be unique
                }
            }
        }


//        dd($request->all());
        ProductPurchase::create([
            'product_id' => $request->product_id,
            'purchase_id' => $purchase_no,
            'vendor_id' => $request->vendor_id,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'total' => $request->quantity * $request->unit_price,
            'created_at' => Carbon::now(),
            'year' => Carbon::now()->translatedFormat('Y'),
            'month' => Carbon::now()->translatedFormat('F'),
        ]);
        FeedProduct::where('id',$request->product_id)->increment('sku',$request->quantity);

        $message = 'Product Purchased Successfully !!';
        return back()->with('success', $message);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
