<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    static function generateMenu()
    {

        return Page::join('categories', 'pages.id', '=', 'categories.page_id')
            ->join('slugs','pages.id','=','slugs.page_id')
            ->join('seo_sets', 'pages.id','=','seo_sets.page_id')
            ->select('*','categories.id as category_id')
            ->get();

    }

}
