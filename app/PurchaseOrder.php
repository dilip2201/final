<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $table = 'purchase_orders';
    protected $fillable = [
       'created_by','time','order_number','total_price','status'
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User','created_by','id');
    }

    public function items()
    {
        return $this->belongsToMany('App\Item', 'purchase_order_items','purchase_order_id','item_id')->withPivot('price','quantity','total_price','random_number');
    }
    public function totalitems()
    {
        return $this->belongsToMany('App\Item', 'purchase_order_items','purchase_order_id','item_id')->withPivot('price','quantity','total_price','random_number');
    }
}
