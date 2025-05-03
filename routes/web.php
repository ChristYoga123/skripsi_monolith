<?php

use Illuminate\Support\Facades\Route;
use RalphJSmit\Laravel\SEO\Support\SitemapTag;

require __DIR__.'/cp.php';
require __DIR__.'/laos-course.php';

// SEO Routes
// Route::get('/sitemap.xml', function()
// {
//     $siteMap = SitemapTag::make()
//         ->add(route('cp.home.index'), now());

//     return $siteMap->toResponse();
// });
