<?php

use App\Enums\Webpages\WebpageTemplate;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageUpdateRequest;
use App\Http\Resources\Views\Admin\Pages\CreateEditPageResource;
use App\Http\Resources\Views\DetailsViewResource;
use App\Http\Resources\Views\Public\Content\PageContentResource;
use App\Http\Resources\Views\Public\Metadata\PageMetadataResource;
use App\Models\Page;
use App\Models\User;

arch('it extends the expected abstract controller')
    ->expect(PageController::class)
    ->toExtend(Controller::class);

test('show renders the page preview view', function (Page $page) {
    $route = route('admin.page.show', [$page]);
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
})->with('pages');

test('show renders the 404 view for unknown pages', function () {
    $url = url('admin/pages/101/preview');
    $user = User::factory()->isAdmin()->create();
    $actual = $this->actingAs($user)->get($url);
    $session = session()->all();

    $actual
        ->assertStatus(404)
        ->assertSessionHasNoErrors();

    expect($session)->toHaveCorrectSessionValues($url);
});

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
            WebpageTemplate::ADMIN_CREATE_EDIT->value,
            $data['content'],
            $data['metadata']
        );
})->with('pages');

test('edit renders the 404 view for unknown pages', function () {
    $url = url('admin/pages/101');
    $user = User::factory()->isAdmin()->create();
    $actual = $this->actingAs($user)->get($url);
    $session = session()->all();

    $actual
        ->assertStatus(404)
        ->assertSessionHasNoErrors();

    expect($session)->toHaveCorrectSessionValues($url);
});

test('update validates requests with a form request')
    ->assertActionUsesFormRequest(
        PageController::class,
        'update',
        PageUpdateRequest::class
    );

test('update returns correctly for minimum valid data', function (Page $page) {
    $page_original = $page;
    $route = route('admin.page.edit', [$page]);
    $user = User::factory()->isAdmin()->create();
    $data = [
        'title' => $page->getTitle() . ' - UPDATED',
        'webpageStatusId' => $page->webpage_status_id,
        'inSitemap' => (bool) $page->in_sitemap,
    ];

    $actual = $this
        ->actingAs($user)
        ->assertAuthenticated()
        ->from($route)
        ->patch($route, $data);

    $actual
        ->assertSessionHasNoErrors()
        ->assertRedirect($route);

    $page->refresh();

    expect($page->title)->toEqual($data['title']);
    expect($page->meta_description)->toEqual($page_original->meta_description);
    expect($page->webpage_status_id)->toEqual($page_original->webpage_status_id);
    expect($page->in_sitemap)->toEqual($page_original->in_sitemap);
    expect($page->blocks)->toEqual($page_original->blocks);
})->with('pages');

test('update returns correctly for maximum valid data', function (Page $page) {
    $page_original = $page;
    $route = route('admin.page.edit', [$page]);
    $user = User::factory()->isAdmin()->create();
    $data = [
        'title' => 'New Title',
        'metaDescription' => 'New Meta-Description',
        'webpageStatusId' => $page->webpage_status_id !== 1 ? 1 : 2,
        'inSitemap' => !$page->in_sitemap,
    ];

    $actual = $this
        ->actingAs($user)
        ->assertAuthenticated()
        ->from($route)
        ->patch($route, $data);

    $actual
        ->assertSessionHasNoErrors()
        ->assertRedirect($route);

    $page->refresh();

    expect($page->title)->toEqual($data['title']);
    expect($page->meta_description)->toEqual($data['metaDescription']);
    expect($page->webpage_status_id)->toEqual($data['webpageStatusId']);
    expect($page->in_sitemap)->toEqual($data['inSitemap']);
    expect($page->blocks)->toEqual($page_original->blocks);
})->with('pages');

test('update ignores unknown fields', function () {
    $page = Page::factory()->create();
    $page_original = $page;
    $route = route('admin.page.edit', [$page]);
    $user = User::factory()->isAdmin()->create();
    $data = [
        'title' => $page->getTitle() . ' - UPDATED',
        'webpageStatusId' => $page->webpage_status_id,
        'inSitemap' => (bool) $page->in_sitemap,
        'unknownField' => 'invalid value',
    ];

    $actual = $this
        ->actingAs($user)
        ->assertAuthenticated()
        ->from($route)
        ->patch($route, $data);

    $actual
        ->assertSessionHasNoErrors()
        ->assertRedirect($route);

    $page->refresh();

    /** @phpstan-ignore-next-line (Intentionally accessing undefined property as part of the test.) */
    expect($page->unknown_field)->toBeNull();
    expect($page->title)->toEqual($data['title']);
    expect($page->meta_description)->toEqual($page_original->meta_description);
    expect($page->webpage_status_id)->toEqual($page_original->webpage_status_id);
    expect($page->in_sitemap)->toEqual($page_original->in_sitemap);
    expect($page->blocks)->toEqual($page_original->blocks);
});

test('update returns a 404 status for unknown pages', function () {
    $url = url('admin/pages/101');
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

test('update throws a validation error for invalid data', function (array $page_array, array $expected) {
    $page = Page::factory()->create();
    $route = route('admin.page.edit', [$page]);
    $user = User::factory()->isAdmin()->create();

    $actual = $this
        ->actingAs($user)
        ->assertAuthenticated()
        ->from($route)
        ->patch(route('admin.page.update', [$page]), $page_array);

    $actual
        ->assertSessionHasErrors($expected)
        ->assertRedirect($route);
})->with('page-arrays-update-invalid');
