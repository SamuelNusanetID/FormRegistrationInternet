<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoList extends Model
{
    protected $table = 'promo_list';
    protected $fillable = [
        'promo_code',
        'package_name',
        'package_top',
        'discount_cut',
        'monthly_cut',
        'activate_date',
        'expired_date'
    ];

    public function ServiceList()
    {
        return $this->hasOne(ServicesList::class, 'id', 'package_id');
    }
}
