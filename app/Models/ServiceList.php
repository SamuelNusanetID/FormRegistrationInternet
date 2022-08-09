<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceList extends Model
{
    protected $table = 'Services_List';
    protected $primaryKey = 'id';
    protected $fillable = [
        'service_name',
        'service_price'
    ];
}
