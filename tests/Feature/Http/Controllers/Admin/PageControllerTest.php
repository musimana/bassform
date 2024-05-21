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

test('update returns correctly for minimum valid data', function (Page $page) {
    $page_original = $page;
    $route = route('admin.page.edit', [$page]);
    $user = User::factory()->isAdmin()->create();
    $data = [
        'title' => $page->getTitle() . ' - UPDATED',
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
    expect($page->subtitle)->toEqual($page_original->subtitle);
    expect($page->content)->toEqual($page_original->content);
    expect($page->meta_title)->toEqual($page_original->meta_title);
    expect($page->meta_description)->toEqual($page_original->meta_description);
    expect($page->in_sitemap)->toEqual($page_original->in_sitemap);
    expect($page->blocks)->toEqual($page_original->blocks);
})->with('pages');

test('update returns correctly for maximum valid data', function (Page $page) {
    $page_original = $page;
    $route = route('admin.page.edit', [$page]);
    $user = User::factory()->isAdmin()->create();
    $data = [
        'title' => 'New Title',
        'subtitle' => 'New Subtitle',
        'content' => '<p>New content.</p>',
        'metaTitle' => 'New Meta-Title',
        'metaDescription' => 'New Meta-Description',
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
    expect($page->subtitle)->toEqual($data['subtitle']);
    expect($page->content)->toEqual($data['content']);
    expect($page->blocks)->toEqual($page_original->blocks);
})->with('pages');

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
