<?php

namespace App\Http\Controllers\Dashboard;

use App\Brand;
use App\Category;
use App\CustomerOrder;
use App\CustomerOrderDetails;
use App\FeedProduct;
use App\Http\Controllers\Controller;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedProducts = FeedProduct::get();
        return view('backend.layouts.Feed.all_feed_roducts', compact('feedProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::where('status', 1)->get();
        $brands = json_decode(json_encode($brands, true), true);
        return view('backend.layouts.feed.product_create_form', compact('brands'));
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
            'f_product_name'=>'required|unique:feed_products,f_product_name',
            'slug'=>'required',
            'description'=>'required',
           'brand_id' => 'required',
           'unit_type' => 'required',
        ]);
        FeedProduct::create([
            'f_product_name' => $request->f_product_name,
            'created_admin' => Auth::guard('admin')->user()->id,
            'description' => $request->description,
            'brand_id' => $request->brand_id,
            'unit_type' => $request->unit_type,
            'slug' => $request->slug,
            'created_at' => Carbon::now(),
            'status' => 1,
        ]);
        $message = 'Product created Successfully !!';
        return redirect()->route('feed-products.index')->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands = Brand::where('status', 1)->get();
        $brands = json_decode(json_encode($brands, true), true);
        $product = FeedProduct::find($id);
        return view('backend.layouts.feed.product_edit_form', compact('product', 'brands'));

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
        FeedProduct::find($id)->update([
            'f_product_name' => $request->f_product_name,
            'description' => $request->description,
            'updated_admin' => $request->description,
            'brand_id' => $request->brand_id,
            'unit_type' => $request->unit_type,
            'slug' => $request->slug,
            'updated_admin' => Auth::guard('admin')->user()->id,
        ]);
        $message = "Product Updated Successfully !!";
        return back()->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
    public function productDelete($id)
    {
        if (CustomerOrderDetails::where('product_id', '=', $id)->exists()) {
            $message = "Sorry you can't delete this coz this header dconected with some specification !!";
            return back()->with('error', $message);
        }else{
            $product = FeedProduct::find($id);
            $product->delete();
            $message = "Product Deleted Successfully !!";
            return back()->with('success', $message);
        }

    }
}
