<?php

namespace App\Http\Controllers;


use App\Models\Challenge;
use App\Models\Say;
use App\Models\User;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    use GeneralTrait;


    // to add user data like name , avatar and time
    public function userData(Request $request)
    {

        $user = User::create([
            'name' => $request->input('name'),
            'avatar' => $request->input('avatar'),
        ]);

        return $this->return3Data('id',$user->id,'name',$user->name,
            'avatar',$user->avatar,'You login successfully','201');
    }


    // to add challenge
    public function addChallenge(Request $request)
    {
        $challenge = Challenge::create([
            'value' => $request->input('value'),
        ]);

        return $this->return2Data('id',$challenge->id,'value',$challenge->value,'challenge added successfully','201');
    }



    // to get user profile
    public function userProfile(Request $request)
    {
        $user = User::find($request->input('user_id'));

        if($user)
        {
            return $this->return3Data('id',$user->id,'name',$user->name,
                'avatar',$user->avatar,'Welcome in your profile','201');
        }
    }



    // to add say
    public function addSay(Request $request)
    {
        $say = Say::create([
            'value' => $request->input('value'),
        ]);

        return $this->return2Data('id',$say->id,'value',$say->value,'Say added successfully','201');
    }



    // to get one says
    public function getSay()
    {
        $say = Say::select('id','value')->inRandomOrder()->take(1)->get();

            return $this->returnData('say',$say,'Today Say','201');

    }



    // to show 4 challenges
    public function getFourChallenges(Request $request)
    {

        $user = User::find( $request->input('user_id') );
        if($user)
        {
            $challenges = Challenge::whereDoesntHave('users',function (Builder $q) use ($request)
            {
                $q->where('user_id', $request->input('user_id'));
            })->inRandomOrder()->take(4)->get();

            return $this->return2Data('userId',$user->id,'challenges',$challenges,'success',201);
        }

        else
        {
            return $this->returnError('404','Failed');
        }

    }



    // to accept challenge to do
    public function acceptChallenge(Request $request)
    {
        $user = User::find( $request->input('user_id') );
        $challenge = Challenge::find($request->input('challenge_id'));

        if ($user && $challenge)
        {
            $user->challenges()->syncWithoutDetaching( $request->input('challenge_id'));
            $time = $_SERVER['REQUEST_TIME'];

            return $this->return3Data('id',$challenge->id,'value',$challenge->value,'timeToStart ',$time,'Accept Challenge to done','201');
        }
        else
        {
            return $this->returnError('404','Failed');
        }

    }



    // to return all challenges for user
    public function getUserChallenge(Request $request)
    {
        $user = User::with('challenges')->find($request->input('user_id'));

        return $this->return4Data('id',$user->id,'name',$user->id,'avatar',$user->avatar,
            'challenges',$user->challenges,'Challenges for specific user','201');
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
