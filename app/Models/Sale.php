<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['product_id', 'product_name','price', 'quantity', 'saller_name', 'buyer_name', 'sales_date', 'sales_status', 'created_at', 'updated_at'];
}