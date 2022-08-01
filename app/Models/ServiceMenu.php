<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceMenu extends Model
{
    protected $table = 'service_menus';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
        'service_name',
        'service_price',
        'discount',
        'started_at',
        'expired_at'
    ];
}
