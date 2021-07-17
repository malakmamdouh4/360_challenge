<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{

    protected $fillable = [
        'value' , 'available' ,'user_id'
    ];

    protected $hidden = [
        'user'
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }


}
