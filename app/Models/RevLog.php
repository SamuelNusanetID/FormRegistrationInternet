<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevLog extends Model
{
    // use HasFactory;
    protected $table = 'tabel_log_revisi';
    protected $keyType = 'string';
    protected $fillable = [
        'status_message',
        'revision_message',
        'pic'
    ];
}
