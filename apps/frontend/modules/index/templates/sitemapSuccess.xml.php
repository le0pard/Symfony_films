<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet href="/css/sitemap.xsl" type="text/xsl"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
   <url>
      <loc><?php echo url_for('@homepage', true) ?></loc>
      <lastmod><?php echo strftime('%Y-%m-%d', time()) ?></lastmod>
      <changefreq>daily</changefreq>
      <priority>1</priority>
   </url>
   <?php foreach($films as $film): ?>
   <url>
      <loc><?php echo url_for('film_show', $film, true) ?></loc>
      <lastmod><?php echo strftime('%Y-%m-%d', $film->getUpdateData('U')) ?></lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.8</priority>
   </url>
   <?php endforeach ?>
   <?php foreach($static_pages as $static_page): ?>
   <url>
      <loc><?php echo url_for('static_page', $static_page, true) ?></loc>
      <lastmod><?php echo strftime('%Y-%m-%d', $static_page->getUpdatedAt('U')) ?></lastmod>
      <changefreq>monthly</changefreq>
      <priority>0.5</priority>
   </url>
   <?php endforeach ?>
</urlset>