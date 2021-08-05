<?php

namespace App\Traits ;

trait GeneralTrait
{
    public function getCurrentlang()
    {
        return app()->getLocale();
    }

    public function returnError($errNum,$msg)
    {
        return response()->json([
            'status' => false ,
            'errNum' => $errNum ,
            'msg' => $msg
        ]);
    }

    public function returnSuccessMessage($msg,$errNum)
    {
        return [
            'status' => true ,
            'errNum' => $errNum ,
            'msg' => $msg
        ];
    }

    public function returnData($key,$value,$msg,$errNum)
    {
        return response()->json([
            'status' => true ,
            'errNum' => $errNum ,
            'msg' => $msg ,
            $key => $value
        ]);
    }


    public function return2Data($param1,$value1,$param2,$value2,$msg,$errNum)
    {
        return response()->json([
            'status' => true ,
            'errNum' => $errNum ,
            'msg' => $msg ,
            $param1 => $value1,
            $param2 =>$value2
        ]);
    }


    public function return3Data($param1,$value1,$param2,$value2,$param3,$value3,$msg,$errNum)
    {
        return response()->json([
            'status' => true ,
            'errNum' => $errNum ,
            'msg' => $msg ,
            $param1 => $value1,
            $param2 =>$value2 ,
            $param3 => $value3
        ]);
    }



    public function return4Data($param1,$value1,$param2,$value2,$param3,$value3,$param4,$value4,$msg,$errNum)
    {
        return response()->json([
            'status' => true ,
            'errNum' => $errNum ,
            'msg' => $msg ,
            $param1 => $value1,
            $param2 =>$value2 ,
            $param3 => $value3,
            $param4 => $value4
        ]);
    }

    public function returnAllDates($hours,$hourValue,$minutes,$minuteValue,$periods,$periodValue,$msg,$errNum)
    {
        return response()->json([
            'status' => true ,
            'errNum' => $errNum ,
            'msg' => $msg ,
            $hours => $hourValue,
            $minutes =>$minuteValue,
            $periods => $periodValue
        ]);
    }


    public function returnCodeAccordingToInput($validator)
    {
        $inputs = array_keys($validator->errors()->toArray());
        $code = $this->getErrorCode($inputs[0]);
        return $code;
    }

    public function getErrorCode($input)
    {
        if($input == "name")
        {
            return "E0011" ;
        }
        elseif($input == "password")
        {
            return "E002" ;
        }
        elseif($input == "mobile")
        {
            return "E003" ;
        }
        elseif($input == "email")
        {
            return "E004" ;
        }
        else
        {
            return "E005";
        }
    }

    public function returnValidationError($code = "E001",$validator)
    {
        return $this->returnError($code,$validator->errors()->first());
    }
}
