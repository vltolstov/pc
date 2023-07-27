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

    static function generateMainMenu()
    {

        $data['catalog-items'] = Page::select('*')
            ->join('categories', 'pages.id', '=', 'categories.page_id')
            ->join('slugs', 'pages.id', '=', 'slugs.page_id')
            ->where('active', 1)
            ->get();

        $data['menu-engineering'] = Page::select('*')
            ->join('images', 'pages.id','=','images.page_id')
            ->join('slugs', 'pages.id', '=', 'slugs.page_id')
            ->where('parent_id', 12)
            ->where('active', 1)
            ->orderBy('pages.created_at', 'desc')
            ->get();

        $data['menu-portfolio'] = Page::select('*')
            ->join('seo_sets', 'pages.id','=','seo_sets.page_id')
            ->join('slugs', 'pages.id', '=', 'slugs.page_id')
            ->where('pages.id', 11)
            ->first();

        $data['menu-projects'] = Page::select('*')
            ->join('images', 'pages.id','=','images.page_id')
            ->where('parent_id', 11)
            ->where('active', 1)
            ->limit(8)
            ->inRandomOrder()
            ->get();

        $data['last-review'] = Page::select('pages.*', 'slugs.urn', 'seo_sets.title', 'content_sets.introtext')
            ->join('seo_sets', 'pages.id','=','seo_sets.page_id')
            ->join('content_sets', 'pages.id','=','content_sets.page_id')
            ->join('slugs', 'pages.id', '=', 'slugs.page_id')
            ->where('parent_id', 55)
            ->where('active', 1)
            ->orderBy('pages.created_at', 'desc')
            ->first();

        $data['last-news'] = Page::select('pages.*', 'slugs.urn', 'seo_sets.title', 'content_sets.introtext')
            ->join('seo_sets', 'pages.id','=','seo_sets.page_id')
            ->join('content_sets', 'pages.id','=','content_sets.page_id')
            ->join('slugs', 'pages.id', '=', 'slugs.page_id')
            ->where('parent_id', 10)
            ->where('active', 1)
            ->orderBy('pages.created_at', 'desc')
            ->first();

        $data['menu-about-company'] = Page::select('*')
            ->join('seo_sets', 'pages.id','=','seo_sets.page_id')
            ->join('content_sets', 'pages.id','=','content_sets.page_id')
            ->join('slugs', 'pages.id', '=', 'slugs.page_id')
            ->where('pages.id', 4)
            ->first();

        $data['menu-serts'] = Page::select('*')
            ->join('seo_sets', 'pages.id','=','seo_sets.page_id')
            ->join('slugs', 'pages.id', '=', 'slugs.page_id')
            ->where('pages.id', 56)
            ->first();

        $data['menu-manufacturers'] = Page::select('*')
            ->join('seo_sets', 'pages.id','=','seo_sets.page_id')
            ->join('content_sets', 'pages.id','=','content_sets.page_id')
            ->join('slugs', 'pages.id', '=', 'slugs.page_id')
            ->where('pages.id', 57)
            ->first();

        return $data;

    }

}
