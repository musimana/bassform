<?php

use App\Enums\Webpages\WebpageStatus;
use App\Enums\Webpages\WebpageTemplate;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('makes page models')
    ->expect(fn () => Page::factory()->make(['title' => 'Test Title']))
    ->title->toEqual('Test Title')
    ->slug->toBeString()
    ->meta_description->toBeNull()
    ->template->toEqual(WebpageTemplate::PUBLIC_CONTENT->value)
    ->webpage_status_id->toEqual(WebpageStatus::PUBLISHED->value)
    ->in_sitemap->toBeTrue()
    ->is_homepage->toBeFalse();

it('makes the about page model')
    ->expect(fn () => Page::factory()->aboutPage()->make(['title' => 'Test Title']))
    ->title->toEqual('Test Title')
    ->slug->toEqual('about')
    ->webpage_status_id->toEqual(WebpageStatus::PUBLISHED->value)
    ->meta_description->toBeString()
    ->template->toEqual(WebpageTemplate::PUBLIC_CONTENT->value)
    ->in_sitemap->toBeTrue()
    ->is_homepage->toBeFalse();

it('makes dummy page models')
    ->expect(fn () => Page::factory()->dummy()->make())
    ->title->tobeString()
    ->slug->toBeString()
    ->meta_description->toBeString()
    ->template->toEqual(WebpageTemplate::PUBLIC_CONTENT->value)
    ->webpage_status_id->toEqual(WebpageStatus::PUBLISHED->value)
    ->in_sitemap->toBeTrue()
    ->is_homepage->toBeFalse();

it('makes the homepage page model')
    ->expect(fn () => Page::factory()->homePage()->make())
    ->title->toBeString()
    ->slug->toEqual('home')
    ->meta_description->toBeString()
    ->template->toEqual(WebpageTemplate::PUBLIC_CONTENT->value)
    ->webpage_status_id->toEqual(WebpageStatus::PUBLISHED->value)
    ->in_sitemap->toBeFalse()
    ->is_homepage->toBeTrue();

it('makes the privacy page model')
    ->expect(fn () => Page::factory()->privacyPage()->make())
    ->title->toEqual('Privacy Policy')
    ->slug->toEqual('privacy')
    ->meta_description->toBeString()
    ->template->toEqual(WebpageTemplate::PUBLIC_CONTENT->value)
    ->webpage_status_id->toEqual(WebpageStatus::PUBLISHED->value)
    ->in_sitemap->toBeTrue()
    ->is_homepage->toBeFalse();
