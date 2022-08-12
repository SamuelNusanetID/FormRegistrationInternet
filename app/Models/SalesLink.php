<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesLink extends Model
{
    protected $table = 'sales_link';
    protected $fillable = [
        'uuid',
        'nama_sales',
        'nama_reseller'
    ];
}
