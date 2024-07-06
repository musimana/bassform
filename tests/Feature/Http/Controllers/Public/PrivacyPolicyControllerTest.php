<?php

use App\Http\Resources\Views\DetailsViewResource;
use App\Http\Resources\Views\Public\Content\PageContentResource;
use App\Http\Resources\Views\Public\Metadata\PageMetadataResource;
use App\Models\Page;

it('can render the privacy page view without a Page model', function () {
    $page = Page::factory()->privacyPage()->make();
    $route = route('privacy');
    $actual = $this->get($route);
    $session = session()->all();
    $headers = $actual->headers->all();

    $actual
        ->assertStatus(200)
        ->assertSessionHasNoErrors()
        ->assertViewIs('app');

    expect($session)->toHaveCorrectSessionValues($route);

    expect($headers)->toHaveCorrectHeaderValues();

    $data = (new DetailsViewResource)->getItem(
        (new PageContentResource($page))->getItem(),
        (new PageMetadataResource)->getItem($page)
    );

    expect($actual)
        ->toHaveCorrectHtmlHead($page->template)
        ->toHaveCorrectHtmlBody()
        ->toHaveCorrectPropsDetails(
            $page->template,
            $data['content'],
            $data['metadata']
        );
});

it('can render the privacy page view with a Page model', function () {
    $page = Page::factory()->create(['slug' => 'privacy']);
    $route = route('privacy');
    $actual = $this->get($route);
    $session = session()->all();
    $headers = $actual->headers->all();

    $actual
        ->assertStatus(200)
        ->assertSessionHasNoErrors()
        ->assertViewIs('app');

    expect($session)->toHaveCorrectSessionValues($route);

    expect($headers)->toHaveCorrectHeaderValues();

    $data = (new DetailsViewResource)->getItem(
        (new PageContentResource($page))->getItem(),
        (new PageMetadataResource)->getItem($page)
    );

    expect($actual)
        ->toHaveCorrectHtmlHead($page->template)
        ->toHaveCorrectHtmlBody()
        ->toHaveCorrectPropsDetails(
            $page->template,
            $data['content'],
            $data['metadata']
        );
});
