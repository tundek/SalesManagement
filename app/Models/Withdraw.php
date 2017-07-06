<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $fillable = ['totalwithdraw', 'purpose', 'created_by', 'modified_by', 'created_at', 'updated_at'];
}
