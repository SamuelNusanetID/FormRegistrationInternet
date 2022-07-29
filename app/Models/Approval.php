<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $table = 'approvals';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
        'isApproved',
        'isRejected'
    ];
}
