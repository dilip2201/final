<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
       'created_by','customer_type','order_number','total_price','status'
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User','created_by','id');
    }

    public function items()
    {
        return $this->belongsToMany('App\Item', 'order_items','order_id','item_id')->withPivot('price','quantity','total_price','random_number');
    }
    public function totalitems()
    {
        return $this->belongsToMany('App\Item', 'order_items','order_id','item_id')->withPivot('price','quantity','total_price','random_number');
    }


}
