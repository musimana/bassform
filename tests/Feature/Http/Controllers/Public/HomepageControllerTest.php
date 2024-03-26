<?php

use App\Http\Controllers\Public\HomepageController;
use App\Http\Resources\Views\DetailsViewResource;
use App\Http\Resources\Views\Public\Content\HomepageContentResource;
use App\Http\Resources\Views\Public\Metadata\HomepageMetadataResource;

test('TEMPLATE_PUBLIC_INDEX Vue page component exists', function () {
    $template = (new ReflectionClassConstant(
        HomepageController::class,
        'TEMPLATE_PUBLIC_INDEX'
    ))->getValue();

    expect($template)->toBeString();

    $this->assertFileExists(resource_path('js/Pages/' . $template . '.vue'));
});

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
        ->toHaveCorrectHtmlHead(HomepageController::TEMPLATE_PUBLIC_INDEX)
        ->toHaveCorrectHtmlBody()
        ->toHaveCorrectPropsDetails(
            HomepageController::TEMPLATE_PUBLIC_INDEX,
            $data['content'],
            $data['metadata']
        );
});
