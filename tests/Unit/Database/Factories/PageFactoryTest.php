<?php

use App\Enums\Webpages\WebpageTemplate;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('makes page models')
    ->expect(fn () => Page::factory()->make(['title' => 'Test Title']))
    ->title->toEqual('Test Title')
    ->slug->toBeString()
    ->subtitle->toBeNull()
    ->content->toBeNull()
    ->meta_title->toBeNull()
    ->meta_description->toBeNull()
    ->template->toEqual(WebpageTemplate::PUBLIC_CONTENT->value)
    ->in_sitemap->toBeTrue()
    ->is_homepage->toBeFalse();

it('makes the about page model')
    ->expect(fn () => Page::factory()->aboutPage()->make(['title' => 'Test Title']))
    ->title->toEqual('Test Title')
    ->slug->toEqual('about')
    ->subtitle->toBeString()
    ->content->toBeString()
    ->meta_title->toEqual('About')
    ->meta_description->toBeString()
    ->template->toEqual(WebpageTemplate::PUBLIC_CONTENT->value)
    ->in_sitemap->toBeTrue()
    ->is_homepage->toBeFalse();

it('makes dummy page models')
    ->expect(fn () => Page::factory()->dummy()->make())
    ->title->tobeString('Test Title')
    ->slug->toBeString()
    ->template->toEqual(WebpageTemplate::PUBLIC_CONTENT->value)
    ->in_sitemap->toBeTrue()
    ->is_homepage->toBeFalse();

it('makes the homepage page model')
    ->expect(fn () => Page::factory()->homePage()->make())
    ->title->toBeString()
    ->slug->toEqual('home')
    ->subtitle->toBeString()
    ->content->toBeString()
    ->meta_title->toBeString()
    ->meta_description->toBeString()
    ->template->toEqual(WebpageTemplate::PUBLIC_CONTENT->value)
    ->in_sitemap->toBeFalse()
    ->is_homepage->toBeTrue();

it('makes the privacy page model')
    ->expect(fn () => Page::factory()->privacyPage()->make())
    ->title->toEqual('Privacy Policy')
    ->slug->toEqual('privacy')
    ->subtitle->toBeString()
    ->meta_title->toEqual('Privacy Policy')
    ->meta_description->toBeString()
    ->template->toEqual(WebpageTemplate::PUBLIC_CONTENT->value)
    ->in_sitemap->toBeTrue()
    ->is_homepage->toBeFalse();
