<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsToMany('App\Models\User');
    }



//    use App\Models\User;
//
//$user = User::find(1);
//
//foreach ($user->roles as $role) {
//    //
//}

}
