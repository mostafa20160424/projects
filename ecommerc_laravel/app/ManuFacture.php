<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManuFacture extends Model
{
    protected $table='manufactures';
    protected $fillable=[
        'contact_me',
        'mobile',
        'email',
        'manufacture_name_ar',
        'manufacture_name_en',
        'facebook',
        'twitter',
        'website',
        'lat',
        'lng',
        'logo',
    ];
}
