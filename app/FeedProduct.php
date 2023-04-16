<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedProduct extends Model
{
//    protected $fillable = [
//        'f_product_name', 'slug', 'description', 'brand_id', 'sku', 'admin_id', 'status',
//    ];
    protected $guarded = [];
    public function brand(){
        return $this->belongsTo('App\Brand', 'brand_id');
    }

}
