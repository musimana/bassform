<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Public\PageController;
use App\Http\Resources\Views\DetailsViewResource;
use App\Http\Resources\Views\Public\Content\PageContentResource;
use App\Http\Resources\Views\Public\Metadata\PageMetadataResource;
use App\Models\Page;

arch('it extends the expected abstract controller')
    ->expect(PageController::class)
    ->toExtend(Controller::class);

test('show renders the page view', function (Page $page) {
    $route = route('page.show', [$page]);
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
        (new PageContentResource)->getItem($page),
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
})->with('pages');

test('show renders the 404 view for unknown pages', function () {
    $url = url('/foo');
    $actual = $this->get($url);
    $session = session()->all();

    $actual
        ->assertStatus(404)
        ->assertSessionHasNoErrors();

    expect($session)->toHaveCorrectSessionValues($url);
});
