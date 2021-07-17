<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name' , 'avatar' , 'hour' , 'minute' , 'period'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',  'created_at' , 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


//    public function beginning()
//    {
//        return $this->belongsTo('App\Models\Beginning','user_id');
//    }


    public function challenge()
    {
        return $this->belongsToMany('App\Models\Challenge','user_challenges','user_id', 'challenge_id');
    }


    public function hasAnyChallenge($Challenges){
        if (is_array($Challenges)){
            foreach ($Challenges as $Challenge){
                if ($this->hasChallenge($Challenge)){
                    return true;
                }
            }
        }else{
            if ($this->hasChallenge($Challenges)){
                return true;
            }
        }
        return false;
    }

    public function hasChallenge($Challenge){
        if ($this->Challenges()->where('name',$Challenge)->first()){
            return true;
        }
        return false;
    }





}
