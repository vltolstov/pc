<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvantageController extends Controller
{

    static public function AdvantageDataProcessing($request)
    {

        $advantageArr = [];
        $advantageObject = [];
        $data = $request->input();

        if($request->input('advantage-header-1')){
            $paramIndex = 1;
            foreach ($data as $key => $value) {
                if (preg_match('/advantage-header-[0-9]/', $key) && $value !== null) {
                    $advantageObject['advantage-header'] = $data['advantage-header-' . $paramIndex];
                    $advantageObject['advantage-info'] = $data['advantage-info-' . $paramIndex];

                    $advantageArr[] = $advantageObject;
                    $paramIndex++;
                }
            }
        }

        if(empty($advantageArr)) {
            return null;
        }

        return json_encode($advantageArr);

    }
}
