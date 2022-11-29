<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    // use HasFactory;
    protected $table = 'approvals';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
        'current_staging_area',
        'next_staging_area',
        'array_approval',
        'isSendedtoIS'
    ];
}
