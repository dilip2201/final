<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    protected $table = 'purchase_order_items';
    protected $fillable = [
       'purchase_order_id','item_id','price','quantity'
    ];
    public $timestamps = true;
}
