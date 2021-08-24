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

            return $this->return4Data('id',$user->id,'name',$user->name,'avatar',$user->avatar,
                'challenges',$user->challenges,'Challenges for specific user','201');
    }



    // return count of challenges to a specific user
    public function getCountUserChallenge(Request $request)
    {
        $countChallenge = DB::table('user_challenge')->where('user_id',$request->input('user_id'))
            ->where('active',0)->count();
        return $this->returnData('Your Challenges are ',$countChallenge,'Count of User Challenges','201') ;
    }



    // return feeling about specific challenge
    public function getCountFeeling(Request $request)
    {
        $feeling1 = DB::table('user_challenge')->where('user_id',$request->input('user_id'))
            ->where('active',0)->where('feeling',1)->count();

        $feeling2 = DB::table('user_challenge')->where('user_id',$request->input('user_id'))
            ->where('active',0)->where('feeling',2)->count();

        $feeling3 = DB::table('user_challenge')->where('user_id',$request->input('user_id'))
            ->where('active',0)->where('feeling',3)->count();

        $feeling4 = DB::table('user_challenge')->where('user_id',$request->input('user_id'))
            ->where('active',0)->where('feeling',4)->count();

        return $this->return4Data('feeling1',$feeling1,'feeling2',$feeling2, 'feeling3',
            $feeling3,'feeling4',$feeling4,'Count of feelings about every Challenge','201') ;
    }



    // skip challenge's today
    public function skipChallenge(Request $request)
    {
        DB::table('user_challenge')->where('user_id',$request->input('user_id'))
            ->where('challenge_id',$request->input('challenge_id'))->update(['active'=>1]);

        return $this->returnSuccessMessage('skipping the challenge successfully','201');
    }



    // send feeling for doing challenge
    public function sendFeeling(Request $request)
    {
        DB::table('user_challenge')->where('user_id',$request->input('user_id'))
            ->where('challenge_id',$request->input('challenge_id'))
            ->where('active',0)
            ->update(['feeling'=>$request->input('feeling')]);

        return $this->returnSuccessMessage('you send your feeling successfully','201');
    }



    // send feeling for skipping challenge
    public function sendSkipping(Request $request)
    {
        DB::table('user_challenge')->where('user_id',$request->input('user_id'))
            ->where('challenge_id',$request->input('challenge_id'))
            ->where('active',1)
            ->update(['skipping'=>$request->input('skipping')]);

        return $this->returnSuccessMessage('sorry, you skip this challenge','201');
    }


































}
