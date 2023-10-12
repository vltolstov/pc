<?= '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($pages as $page)
        <url>
            <loc>{{$baseUrl}}/{{$page->urn}}</loc>
            <lastmod>{{$page->updated_at->format('Y-m-d')}}</lastmod>
            <changefreq>{{$page->changefreq}}</changefreq>
            <priority>{{$page->priority}}</priority>
        </url>
    @endforeach
</urlset>


