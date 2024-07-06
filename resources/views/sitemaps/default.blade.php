<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($items as $sitemap)
    <sitemap>
        <loc>{{ $sitemap }}</loc>
    </sitemap>
    @endforeach
</sitemapindex>
