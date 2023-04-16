<?php

namespace App\Http\Controllers\Dashboard;

use App\Customer;
use App\CustomerCart;
use App\CustomerDuePaid;
use App\CustomerOrder;
use App\CustomerOrderDetails;
use App\FeedProduct;
use App\Http\Controllers\Controller;
use App\Order;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::get();
        return view('backend.layouts.Customer.customer_list', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
           'customer_name' => 'required',
           'customer_number' => 'required|unique:customers,customer_number|numeric|digits:11',
           'customer_address' => 'required',
        ]);

        Customer::create([
           'customer_name'=> $request->customer_name,
           'customer_number'=> $request->customer_number,
           'customer_address'=> $request->customer_address,
        ]);
        $message = 'Customer Crated Successfully';
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
        $customer = Customer::find($id);
        return view('backend.layouts.Customer.customer_edit', compact('customer'));
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
        $customer = Customer::find($id);
        $customer->update([
            'customer_name'=> $request->customer_name,
            'customer_number'=> $request->customer_number,
            'customer_address'=> $request->customer_address,
        ]);
        return redirect()->route('customer.index')->with('success', 'Customer updated successfully');
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

    public function customerOrder($id){
        $customer_id = $id;
        $feedProducts = $feedProducts = FeedProduct::get();
        return view('backend.layouts.customer.customer_order', compact('customer_id', 'feedProducts'));
    }
    public function customerCart(Request $request){
        $request->validate([
           'product_quantity'=> 'required',
           'price'=> 'required'
        ]);
        $cart =  $request->all();
        if( $cart['product_quantity'] > FeedProduct::where('id',$cart['product_id'])->value('sku')){
            return back()->with('error_msg', 'Sorry!! This quantity not available right now !!');
        }else{
            if(CustomerCart::where('customer_id', $cart['customer_id'])->where('product_id', $cart['product_id'])->exists()){
                CustomerCart::where('customer_id', $cart['customer_id'])->where('product_id', $cart['product_id'])->increment('product_quantity', $cart['product_quantity']);
                $product_name = FeedProduct::where('id', $cart['product_id'])->value('f_product_name');
                return back()->with('success', $product_name);
            }else{
                CustomerCart::create([
                    'product_id' => $cart['product_id'],
                    'product_quantity' => $cart['product_quantity'],
                    'customer_id' => $cart['customer_id'],
                    'price' => $cart['price'],
                    'created_at' => Carbon::now()->toDateString(),
                ]);
                $product_name = FeedProduct::where('id', $cart['product_id'])->value('f_product_name');
                return back()->with('success', $product_name);
            }
        }
    }
    public function customerCartView($id){
        $customerId = $id;
        $customerCartProducts = CustomerCart::where('customer_id', $customerId)->get();
        $total_price = 0;
        foreach ($customerCartProducts as $product){
            $total_price += $product->product_quantity * $product->price;
        }
        return view('backend.layouts.customer.customer_cart_view', compact('customerCartProducts', 'total_price','customerId'));
    }
    public function customerCartUpdate (Request $request){
        foreach($request->cart_id as $key=>$id){
            if($request->product_quantity[$key] > FeedProduct::where('id',CustomerCart::where('id', $id)->value('product_id'))->value('sku')){
                return back()->with('error', 'Not availabel quantity !!');
            }else{
                CustomerCart::find($id)->update([
                    'product_quantity'=>$request->product_quantity[$key]
                ]);
            }

        }
        return back()->with('success', 'Cart Table updated successfully !!');
    }
    public function customerCartDelete($id){
        CustomerCart::find($id)->delete();
        return back()->with('success', 'Cart item deleted successfully !!');
    }

    public  function  customerCheckout(Request $request){
        $request->validate([
            'customer_paid' => 'required',
        ]);

        foreach (range(date('Y'), date('Y') + 10) as $y) {
            if ($y == date('Y')) {
                $allOrders = CustomerOrder::where('year', date('Y'))->get();
                $countOrder = count($allOrders) + 1;
                if ($countOrder < 10) {

                    $tran_id = 'UPF-CUS-' . Carbon::now()->translatedFormat('Y') . '-' . '00000' . $countOrder ;
                    ; // tran_id must be unique
                } elseif ($countOrder >= 10 && $countOrder <= 99) {
                    $tran_id = 'UPF-CUS-' . Carbon::now()->translatedFormat('Y') . '-' . '0000' . $countOrder ;
                    ; // tran_id must be unique
                } elseif ($countOrder >= 100 && $countOrder <= 999) {
                    $tran_id= 'UPF-CUS-' . Carbon::now()->translatedFormat('Y') . '-' . '000' . $countOrder ;
                    ; // tran_id must be unique
                } elseif ($countOrder >= 1000 && $countOrder <= 9999) {
                    $tran_id = 'UPF-CUS-' . Carbon::now()->translatedFormat('Y') . '-' . '00' . $countOrder ;
                    ; // tran_id must be unique
                } elseif ($countOrder >= 10000 && $countOrder <= 99999) {
                    $tran_id = 'UPF-CUS-' . Carbon::now()->translatedFormat('Y') . '-' . '0' . $countOrder ;
                    ; // tran_id must be unique
                } elseif ($countOrder >= 100000) {
                    $tran_id = 'UPF-CUS-' . Carbon::now()->translatedFormat('Y') . '-' . $countOrder ; // tran_id must be unique
                }
            }
        }

        $orderId = CustomerOrder::insertGetId([
           'customer_id' => $request->customer_id,
           'total' => $request->total,
           'tran_id' => $tran_id,
           'cus_due' => $request->customer_due,
           'cus_paid' => $request->customer_paid,
            'year' => Carbon::now()->translatedFormat('Y'),
            'month' => Carbon::now()->translatedFormat('F'),
            'created_at' => Carbon::now(),
        ]);
        $cartAllProducts = CustomerCart::where('customer_id', $request->customer_id)->get();

        foreach ($cartAllProducts as $cart_product) {
            CustomerOrderDetails::create([
                'customer_id' => $request->customer_id,
                'order_id' => $orderId,
                'product_id' => $cart_product->product_id,
                'quantity' => $cart_product->product_quantity,
                'price' => $cart_product->price,
                'created_at' => Carbon::now()
            ]);
            //insert in order_list table end
            //decrement from product table start
            FeedProduct::find($cart_product->product_id)->decrement('sku',$cart_product->product_quantity);
            //delete from cart table
            CustomerCart::find($cart_product->id)->delete();
        }
        //customer due will add and paid will add
        Customer::where('id', $request->customer_id)->increment('customer_due', $request->customer_due);
        Customer::where('id', $request->customer_id)->increment('customer_paid', $request->customer_paid);
       return redirect()->route('customer-order-list')->with('success', 'Order Created successfully !!');
    }
    public function customerOrderPdf($id){
        $order_no = CustomerOrder::findOrFail($id);

        $order_details = CustomerOrderDetails::where('order_id', $id)->get();
        $customer = Customer::where('id', $order_no->customer_id)->first();

        $order_pdf = PDF::loadView('backend.layouts.customer.customerInvoice', compact('order_details', 'order_no','customer'))->setPaper('a4', 'portrait');
//        return $order_pdf->download('customerInvoice.pdf');
        return $order_pdf->stream($order_no->tran_id.".pdf", array("Attachment" => false));

    }
    public function customerOrderList(){
        $allOrders = CustomerOrder::orderBy('id', 'DESC')->get();
        return view('backend.layouts.customer.customer_order_list', compact('allOrders'));
    }

    public function customerOrderView($id){
        $order_no = CustomerOrder::findOrFail($id);
        $order_details = CustomerOrderDetails::where('order_id', $id)->get();
        $customer = Customer::where('id', $order_no->customer_id)->first();
        return view('backend.layouts.customer.order_details', compact('order_no', 'order_details','customer'));
    }

    public function moneyCollection(){
        $customers = Customer::where('customer_due', '>', 0)->get();
        $collectionList = CustomerDuePaid::get();
        return view('backend.layouts.customer.customer_collection', compact('customers', 'collectionList'));
    }
    public function getCustomerDue(Request $request){
        $customerDue = Customer::where('id', $request->customer_id)->value('customer_due');
        return $customerDue;
    }
    public function customerDuePaid(Request $request){
       $request->validate([
          'customer_id' => 'required',
           'paid_due'=> 'required',
       ]);

        foreach (range(date('Y'), date('Y') + 10) as $y) {
            if ($y == date('Y')) {
                $allOrders = CustomerDuePaid::where('year', date('Y'))->get();
                $countOrder = count($allOrders) + 1;
                if ($countOrder < 10) {

                    $tran_id = 'Paid-id-' . Carbon::now()->translatedFormat('Y') . '-' . '00000' . $countOrder ;
                    ; // tran_id must be unique
                } elseif ($countOrder >= 10 && $countOrder <= 99) {
                    $tran_id = 'Paid-id-' . Carbon::now()->translatedFormat('Y') . '-' . '0000' . $countOrder ;
                    ; // tran_id must be unique
                } elseif ($countOrder >= 100 && $countOrder <= 999) {
                    $tran_id= 'Paid-id-' . Carbon::now()->translatedFormat('Y') . '-' . '000' . $countOrder ;
                    ; // tran_id must be unique
                } elseif ($countOrder >= 1000 && $countOrder <= 9999) {
                    $tran_id = 'Paid-id-' . Carbon::now()->translatedFormat('Y') . '-' . '00' . $countOrder ;
                    ; // tran_id must be unique
                } elseif ($countOrder >= 10000 && $countOrder <= 99999) {
                    $tran_id = 'Paid-id-' . Carbon::now()->translatedFormat('Y') . '-' . '0' . $countOrder ;
                    ; // tran_id must be unique
                } elseif ($countOrder >= 100000) {
                    $tran_id = 'Paid-id-' . Carbon::now()->translatedFormat('Y') . '-' . $countOrder ; // tran_id must be unique
                }
            }
        }

       CustomerDuePaid::create([
           'customer_id' => $request->customer_id,
           'due_before_paid' => $request->due_before_paid,
           'paid_due' => $request->paid_due,
           'due_after_paid' => $request->due_after_paid,
           'due_given_id' => $tran_id,
           'year' => Carbon::now()->translatedFormat('Y'),
           'month' => Carbon::now()->translatedFormat('F'),
           'created_at' => Carbon::now()
       ]);
        Customer::where('id',$request->customer_id)->decrement('customer_due',$request->paid_due);
        Customer::where('id',$request->customer_id)->increment('customer_paid',$request->paid_due);
        return back()->with('success', 'Due Paid successfully !!');
    }

    public function collectionSlip($id){
        $customerPaid = CustomerDuePaid::find($id);

        $collection_pdf = PDF::loadView('backend.layouts.customer.collectionSlip', compact('customerPaid'))->setPaper('a4', 'portrait');
        return $collection_pdf->download('customerInvoice.pdf');
    }


}
