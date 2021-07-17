<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Challenge extends Model
{

    protected $fillable = [
        'value' , 'available'
    ];

    protected $hidden = [
//        'user'
    ];


    public function user()
    {
        return $this->belongsToMany('App\Models\User','user_challenges','user_id', 'challenge_id');
    }


}
