<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
        'customer_id',
        'name',
        'address',
        'class',
        'email',
        'identity_number',
        'phone_number',
        'company_name',
        'company_address',
        'company_npwp',
        'company_phone_number',
        'company_employees',
        'reference_id'
    ];

    public function billing()
    {
        return $this->hasOne(Billing::class, 'id', 'id');
    }

    public function technical()
    {
        return $this->hasOne(Technical::class, 'id', 'id');
    }
}
