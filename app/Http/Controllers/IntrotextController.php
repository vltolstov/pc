<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function Symfony\Component\String\length;
use function Symfony\Component\String\s;

class IntrotextController extends Controller
{

    static function generateIntro($text, $quantity)
    {
        $sentences = explode('. ', $text);
        $paragraph = '';
        $result = [];

        for($i = 1; $i <= count($sentences); $i++){

            $paragraph .= $sentences[$i - 1] . '. ';

            if ($i % $quantity == 0) {
                $result[] = $paragraph;
                $paragraph = '';
            }
        }

        if($paragraph !== '') {
            $result[] = $paragraph;
        }

        $result[count($result) - 1] = substr($result[count($result) - 1], 0, -2);

        return $result;

    }

}
