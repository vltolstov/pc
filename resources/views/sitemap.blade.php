<?= '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($pages as $page)
        <url>
            <loc>{{$baseUrl}}/{{$page->slug->urn}}</loc>
            <lastmod>{{$page->updated_at->format('Y-m-d')}}</lastmod>
            <changefreq>{{$page->seoset->changefreq}}</changefreq>
            <priority>{{$page->seoset->priority}}</priority>
        </url>
    @endforeach
</urlset>


