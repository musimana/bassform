<?php

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;

arch('app/Http has valid architecture')
    ->expect('App\Http')
    ->toBeClasses();

arch('app/Http/Controllers has valid architecture')
    ->expect('App\Http\Controllers')
    ->toExtend(Controller::class)
    ->toHaveSuffix('Controller')
    ->not->toBeUsed()
    ->ignoring(Controller::class);

arch('app/Http/Middleware has valid architecture')
    ->expect('App\Http\Middleware')
    ->toBeFinal()
    ->not->toBeUsed();

arch('app/Http/Requests has valid architecture')
    ->expect('App\Http\Requests')
    ->toExtend(FormRequest::class)
    ->toBeFinal()
    ->toHaveSuffix('Request')
    ->toBeUsedIn('App\Http\Controllers')
    ->toHaveMethod('rules');

arch('app/Http/Resources has valid architecture')
    ->expect('App\Http\Resources')
    ->toBeFinal()
    ->toBeUsedIn('App\Http');

arch('app/Http/Resources/Files has valid architecture')
    ->expect('App\Http\Resources\Files')
    ->toHaveSuffix('FileResource');

arch('app/Http/Resources/Views/Public/Formatters has valid architecture')
    ->expect('App\Http\Resources\Formatters')
    ->toHaveSuffix('FormatterResource')
    ->tohaveMethod('getValue');

arch('app/Http/Resources/Models has valid architecture')
    ->expect('App\Http\Resources\Models')
    ->toHaveSuffix('ModelResource')
    ->toHaveConstructor()
    ->tohaveMethod('getItem');

arch('app/Http/Resources/Views/Admin/Pages has valid architecture')
    ->expect('App\Http\Resources\Views\Admin\Pages')
    ->toHaveSuffix('PageResource');

arch('app/Http/Resources/Views/Auth/Content has valid architecture')
    ->expect('App\Http\Resources\Views\Auth\Content')
    ->toHaveSuffix('ContentResource')
    ->tohaveMethod('getItem');

arch('app/Http/Resources/Views/Auth/Metadata has valid architecture')
    ->expect('App\Http\Resources\Views\Auth\Metadata')
    ->toHaveSuffix('MetadataResource')
    ->tohaveMethod('getItem');

arch('app/Http/Resources/Views/Auth/Summaries has valid architecture')
    ->expect('App\Http\Resources\Views\Auth\Summaries')
    ->toHaveSuffix('SummaryResource')
    ->tohaveMethod('getItem');

arch('app/Http/Resources/Views/Navbars has valid architecture')
    ->expect('App\Http\Resources\Views\Navbars')
    ->toHaveSuffix('NavbarResource');

arch('app/Http/Resources/Views/Public/Content has valid architecture')
    ->expect('App\Http\Resources\Views\Public\Content')
    ->toHaveSuffix('ContentResource')
    ->tohaveMethod('getItem');

arch('app/Http/Resources/Views/Public/Metadata has valid architecture')
    ->expect('App\Http\Resources\Views\Public\Metadata')
    ->toHaveSuffix('MetadataResource')
    ->tohaveMethod('getItem');

arch('app/Http/Resources/Views/Public/Summaries has valid architecture')
    ->expect('App\Http\Resources\Views\Public\Summaries')
    ->toHaveSuffix('SummaryResource')
    ->tohaveMethod('getItem');

arch('app/Http/Resources/Views/Sitemaps has valid architecture')
    ->expect('App\Http\Resources\Views\Sitemaps')
    ->toHaveSuffix('SitemapResource');
