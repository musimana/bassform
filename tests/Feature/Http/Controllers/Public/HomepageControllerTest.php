<?php

it('can render the homepage view', function () {
    $route = route('home');
    $actual = $this->get($route);

    $actual
        ->assertStatus(200)
        ->assertSessionHasNoErrors()
        ->assertViewIs('app');
});
