<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';
    protected $fillable = [
       'item_id','quantity','created_at','updated_at','id'
    ];
    
}
