<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPurchase extends Model
{
    protected $guarded = [];

    public function product(){
        return $this->belongsTo('App\FeedProduct', 'product_id');
    }
    public function vendor(){
        return $this->belongsTo('App\Vendors', 'vendor_id');
    }
}
