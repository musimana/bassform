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
    $status = $page->is_homepage ? 302 : 200;

    $actual
        ->assertStatus($status)
        ->assertSessionHasNoErrors();

    expect($session)->toHaveCorrectSessionValues($route);

    if ($status === 200) {
        $actual->assertViewIs('app');

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
    }
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

test('show renders the 404 view for unknown templates', function () {
    $page = Page::factory()->create(['template' => 'Unknown\UnknownTemplate']);
    $route = route('page.show', [$page]);
    $actual = $this->get($route);
    $session = session()->all();

    $actual
        ->assertStatus(404)
        ->assertSessionHasNoErrors();

    expect($session)->toHaveCorrectSessionValues($route);
});

test('store returns correctly for valid data', function () {
    Page::factory()->create(['slug' => 'forms']);

    $route = route('page.store', 'forms');
    $actual = $this
        ->from($route)
        ->post($route, [
            'text' => 'Test',
            'select' => '1',
            'checkbox' => true,
        ]);

    $actual
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('page.store', 'forms'));
});

test('store returns a 404 status for unknown pages', function () {
    $url = url('/foo');
    $actual = $this
        ->from($url)
        ->post($url, [
            'text' => 'Test',
            'select' => '1',
            'checkbox' => true,
        ]);
    $session = session()->all();

    $actual
        ->assertStatus(404)
        ->assertSessionHasNoErrors();

    expect($session)->toHaveCorrectSessionValues($url);
});
