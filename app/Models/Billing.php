<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $table = 'billings';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
        'billing_name',
        'billing_contact',
        'billing_email'
    ];
}
