<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Challenge extends Model
{

    protected $fillable = [
        'value'
    ];

    protected $hidden = [
        'pivot' , 'created_at' ,'updated_at'
    ];


    public function users()
    {
        return $this->belongsToMany('App\Models\User','user_challenge'
            , 'challenge_id' , 'user_id');
    }


}
