<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = ['staff_id', 'paid_date', 'paid_amount', 'created_by', 'modified_by', 'created_at', 'updated_at'];
}
