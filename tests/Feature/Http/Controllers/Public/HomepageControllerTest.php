<?php

use App\Enums\Webpages\WebpageTemplate;
use App\Http\Resources\Views\DetailsViewResource;
use App\Http\Resources\Views\Public\Content\HomepageContentResource;
use App\Http\Resources\Views\Public\Metadata\HomepageMetadataResource;

it('can render the homepage view', function () {
    $route = route('home');
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
        (new HomepageContentResource)->getItem(),
        (new HomepageMetadataResource)->getItem()
    );

    expect($actual)
        ->toHaveCorrectHtmlHead(WebpageTemplate::PUBLIC_INDEX->value)
        ->toHaveCorrectHtmlBody()
        ->toHaveCorrectPropsDetails(
            WebpageTemplate::PUBLIC_INDEX->value,
            $data['content'],
            $data['metadata']
        );
});
