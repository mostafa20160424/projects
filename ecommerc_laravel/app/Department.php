<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    protected $fillable=[
        'dep_name_ar',
        'dep_name_en',
        'parent_id',
        'icon',
        'description',
        'keyword',
    ];

    public function parent()
    {
        return $this->hasMany('App\Department' , 'id' , 'parent_id');
    }

}
