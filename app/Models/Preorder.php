<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preorder extends Model
{
    protected $fillable = ['product_id', 'quantity', 'totalamount', 'paidamount', 'dueamount', 'customer_name', 'customer_phone', 'order_pick', 'message', 'created_by', 'modified_by', 'created_at', 'updated_at'];
}
