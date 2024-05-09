<?php

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Views\Admin\Pages\CreateEditPageResource;
use App\Http\Resources\Views\DetailsViewResource;
use App\Http\Resources\Views\Public\Metadata\PageMetadataResource;
use App\Models\Page;
use App\Models\User;

arch('it extends the expected abstract controller')
    ->expect(PageController::class)
    ->toExtend(Controller::class);

test('edit renders the page create/edit view', function (Page $page) {
    $route = route('admin.page.edit', [$page]);
    $user = User::factory()->isAdmin()->create();
    $actual = $this->actingAs($user)->get($route);
    $session = session()->all();
    $headers = $actual->headers->all();

    $actual
        ->assertStatus(200)
        ->assertSessionHasNoErrors()
        ->assertViewIs('app');

    expect($session)->toHaveCorrectSessionValues($route);

    expect($headers)->toHaveCorrectHeaderValues();

    $data = (new DetailsViewResource)->getItem(
        (new CreateEditPageResource)->getItem($page),
        (new PageMetadataResource)->getItem($page)
    );

    expect($actual)
        ->toHaveCorrectHtmlHead($page->template)
        ->toHaveCorrectHtmlBody()
        ->toHaveCorrectPropsDetails(
            PageController::TEMPLATE_ADMIN_CREATE_EDIT,
            $data['content'],
            $data['metadata']
        );
})->with('pages');

test('edit renders the 404 view for unknown pages', function () {
    $url = url('admin/pages/foo');
    $user = User::factory()->isAdmin()->create();
    $actual = $this->actingAs($user)->get($url);
    $session = session()->all();

    $actual
        ->assertStatus(404)
        ->assertSessionHasNoErrors();

    expect($session)->toHaveCorrectSessionValues($url);
});

test('update returns correctly for valid data', function () {
    $page = Page::factory()->create(['slug' => 'forms']);
    $route = route('admin.page.edit', [$page]);
    $user = User::factory()->isAdmin()->create();
    $actual = $this
        ->actingAs($user)
        ->from($route)
        ->patch($route, [
            'title' => 'Test',
            'inSitemap' => true,
        ]);

    $actual
        ->assertSessionHasNoErrors()
        ->assertRedirect($route);
});

test('update returns a 404 status for unknown pages', function () {
    $url = url('admin/pages/foo');
    $user = User::factory()->isAdmin()->create();
    $actual = $this
        ->actingAs($user)
        ->from($url)
        ->patch($url, [
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
