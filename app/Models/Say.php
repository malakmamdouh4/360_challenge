<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Say extends Model
{
    protected $fillable = [
        'value'
    ];

    protected $hidden =
        [
            'updated_at' , 'created_at'
        ];
}
