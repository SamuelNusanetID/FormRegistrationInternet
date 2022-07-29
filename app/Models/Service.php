<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
        'service_package',
        'id_photo_url',
        'selfie_id_photo_url'
    ];
}
