<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
    xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
    <url>
        <loc>{{ url("/") }}</loc>
        <lastmod>{{ gmdate(DateTime::W3C, strtotime('now')) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url("/about") }}</loc>
        <lastmod>{{ gmdate(DateTime::W3C, strtotime('now')) }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url("/contact") }}</loc>
        <lastmod>{{ gmdate(DateTime::W3C, strtotime('now')) }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>1.0</priority>
    </url>
    @foreach ($coachings as $coaching)
        <url>
            <loc>{{ url("coaching/$coaching->slug") }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($coaching->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach
</urlset>
