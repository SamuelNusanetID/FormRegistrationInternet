<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // use HasFactory;
    protected $table = 'customers';

    protected $keyType = 'string';
    protected $fillable = [
        'branch_id',
        'customer_id',
        'name',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'address',
        'geolocation',
        'class',
        'email',
        'identity_type',
        'identity_number',
        'npwp_number',
        'npwp_files',
        'phone_number',
        'company_name',
        'company_address',
        'company_npwp',
        'company_npwp_files',
        'company_sppkp',
        'company_sppkp_files',
        'company_phone_number',
        'company_employees',
        'survey_id',
        'extend_note',
        'reference_id',
        'assigned_sales_manager'
    ];


    public function billing()
    {
        return $this->hasOne(Billing::class, 'id', 'id');
    }

    public function technical()
    {
        return $this->hasOne(Technical::class, 'id', 'id');
    }

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'id');
    }

    public function approval()
    {
        return $this->hasOne(Approval::class, 'id', 'id');
    }
}
