<?php

namespace App\Http\Controllers;

use App\Models\Beginning;
use App\Models\Challenge;
use App\Models\Say;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use GeneralTrait;



    // to add user data like name , avatar and time
    public function userData(Request $request)
    {

        $user = User::create([
            'name' => $request->input('name'),
            'avatar' => $request->input('avatar'),
            'hour' => $request->input('hour'),
            'minute' => $request->input('minute'),
            'period' => $request->input('period')
        ]);

        return $this->returnData('user',$user,'You login successfully','201');
    }



    // to get user profile
    public function userProfile(Request $request)
    {
        $user = User::find($request->input('user_id'));

        if($user)
        {
            $data = [ $user->name , $user->avatar ];
            return $this->returnData('user',$data,'Welcome in your profile','201');
        }
    }



    // to get all says
    public function getSay()
    {
        $say = Say::select('value')->inRandomOrder()->take(1)->get();
        return $this->returnData('say is ',$say,'Today Say','201');
    }



    // to return all challenges for user
    public function getUserChallenge(Request $request)
    {
        $challenge= Challenge::with('user')->select('id' , 'value' )->
            where('available',0)->
            where('user_id',$request->input('user_id'))->inRandomOrder() ->limit(4)->get();

        return $this->returnData('Challenges',$challenge,'These challenges belong to this user','201');
    }



    // to accept challenge ( update availability from 0 to 1 )
    public function updateAvailable(Request $request)
    {
        $challenge = Challenge::find($request->input('challenge_id'));
        $user = User::find($request->input('user_id'));

        if($challenge->available == 0 && $user)
        {
            $challenge->available = 1 ;
            $challenge->save();
            return $this->returnSuccessMessage('this challenge become not available','201');
        }
        else
        {
            return $this->returnError('404','invalid id');
        }
    }





}
















//    // to add user image
//    public function userImage(Request $request)
//    {
//        $user = User::find($request->input('user_id'));
//
//        if($user)
//        {
//            $user->avatar = $request->input('avatar');
//            $user->save();
//            return $this->returnData('user_avatar',$user->avatar,'You add your image successfully','201');
//        }
//
//    }



//    // to get all hours
//    public function getDates()
//    {
//        $hours = Hour::select('hour')->get();
//        $minutes = Minute::select('minute')->get();
//        $period = Period::select('period')->get();
//
//        return $this->returnAllDates('Hours',$hours, 'Minutes' ,
//            $minutes ,'Periods',$period,'There ara all dates in app','201');
//    }



// to add user beginning
//    public function userBeginning(Request $request)
//    {
//        $hour = Hour::find($request->input('hour_id'));
//        if($hour)
//        {
//            $hour->user_id = $request->input('user_id') ;
//            $hour->save();
//        }
//
//        $minute = Minute::find($request->input('minute_id'));
//        if($minute)
//        {
//            $minute->user_id = $request->input('user_id') ;
//            $minute->save();
//        }
//
//        $period = Period::find($request->input('period_id'));
//        if($period)
//        {
//            $period->user_id = $request->input('user_id') ;
//            $period->save();
//        }
//
//        $date = [ $hour->hour , $minute->minute , $period->period ];
//
//        return $this->returnData('userDate',$date,'You saved your beginning','201');
//    }
