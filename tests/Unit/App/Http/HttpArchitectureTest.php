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
    ->toBeUsedIn('App\Http');

arch('app/Http/Requests has valid architecture')
    ->expect('App\Http\Requests')
    ->toExtend(FormRequest::class)
    ->toHaveSuffix('Request')
    ->toBeUsedIn('App\Http\Controllers')
    ->toHaveMethod('rules');

arch('app/Http/Resources has valid architecture')
    ->expect('App\Http\Resources')
    ->toBeClasses()
    ->toBeUsedIn('App\Http');

arch('app/Http/Resources/Files has valid architecture')
    ->expect('App\Http\Resources\Files')
    ->toHaveSuffix('FileResource');

arch('app/Http/Resources/Models has valid architecture')
    ->expect('App\Http\Resources\Models')
    ->toHaveSuffix('ModelResource')
    ->toBeUsedIn('App\Http')
    ->toHaveConstructor()
    ->tohaveMethod('getItem');

arch('app/Http/Resources/Views/Auth/Metadata has valid architecture')
    ->expect('App\Http\Resources\Views\Auth\Metadata')
    ->toHaveSuffix('MetadataResource')
    ->toBeUsedIn('App\Http')
    ->tohaveMethod('getItem');

arch('app/Http/Resources/Views/Blocks has valid architecture')
    ->expect('App\Http\Resources\Views\Blocks')
    ->toBeUsedIn('App\Http');

arch('app/Http/Resources/Views/Navbars has valid architecture')
    ->expect('App\Http\Resources\Views\Navbars')
    ->toHaveSuffix('NavbarResource')
    ->toBeUsedIn('App\Http');

arch('app/Http/Resources/Views/Public/Content has valid architecture')
    ->expect('App\Http\Resources\Views\Public\Content')
    ->toHaveSuffix('ContentResource')
    ->toBeUsedIn('App\Http')
    ->tohaveMethod('getItem');

arch('app/Http/Resources/Views/Public/Formatters has valid architecture')
    ->expect('App\Http\Resources\Views\Public\Formatters')
    ->toHaveSuffix('FormatterResource')
    ->toBeUsedIn('App\Http')
    ->tohaveMethod('getValue');

arch('app/Http/Resources/Views/Public/Metadata has valid architecture')
    ->expect('App\Http\Resources\Views\Public\Metadata')
    ->toHaveSuffix('MetadataResource')
    ->toBeUsedIn('App\Http')
    ->tohaveMethod('getItem');

arch('app/Http/Resources/Views/Public/Summaries has valid architecture')
    ->expect('App\Http\Resources\Views\Public\Summaries')
    ->toHaveSuffix('SummaryResource')
    ->toBeUsedIn('App\Http')
    ->tohaveMethod('getItem');

arch('app/Http/Resources/Views/Sitemaps has valid architecture')
    ->expect('App\Http\Resources\Views\Sitemaps')
    ->toHaveSuffix('SitemapResource')
    ->toBeUsedIn('App\Http');
