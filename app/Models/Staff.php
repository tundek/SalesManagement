<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = "staffs";
    protected $fillable = ['name', 'phone', 'designation', 'sallery', 'created_by', 'modified_by', 'status', 'created_at', 'updated_at'];
}
