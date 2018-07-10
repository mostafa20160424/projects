<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TradeMark extends Model
{
    protected $table='trademarks';
    protected $fillable=[
        'trademark_name_ar',
        'trademark_name_en',
        'logo',
    ];
}
