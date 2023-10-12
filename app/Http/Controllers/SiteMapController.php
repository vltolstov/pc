<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class SiteMapController extends Controller
{

    public function sitemap()
    {

        $pages = Page::select('*')
            ->leftJoin('seo_sets', 'pages.id', '=', 'seo_sets.page_id')
            ->leftJoin('slugs', 'pages.id', '=', 'slugs.page_id')
            ->get();

        $actualDate = date('Y-m-d');
        $sitemapDate = new \DateTime($actualDate);
        $sitemapDate->modify("-3 day");

        foreach ($pages as $page) {
            $page->updated_at = $sitemapDate;
        }

        return response()
            ->view('sitemap', ['pages' => $pages])
            ->header('Content-Type', 'text/xml');
    }

}
