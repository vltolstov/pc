<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class SiteMapController extends Controller
{

    public function sitemap()
    {
        $pages = Page::all();
        $pages = $pages->fresh('seoSet');

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
