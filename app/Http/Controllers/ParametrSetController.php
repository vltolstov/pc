<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParametrSetController extends Controller
{

    public static function ParametrDataProcessing($request)
    {

        $paramArr = [];
        $paramObject = [];

        $data = $request->input();

        foreach ($data as $key => $value) {
            if (preg_match('/param-name-[0-9]/', $key) && $value !== null) {
                $paramObject['name'] = $value;
                $paramIndex = substr($key, mb_strlen('param-name-'));
                $paramObject['value'] = $data['param-value-' . $paramIndex];
                $paramObject['active'] = $request->boolean('param-active-' . $paramIndex);
                $paramObject['hide'] = $request->boolean('param-hide-' . $paramIndex);

                $paramArr[] = $paramObject;
            }
        }

        if(empty($paramArr)) {
            return null;
        }

        return json_encode($paramArr);

    }

}
