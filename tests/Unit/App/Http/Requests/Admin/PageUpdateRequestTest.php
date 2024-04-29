<?php

use App\Http\Requests\Admin\PageUpdateRequest;
use App\Interfaces\Requests\RequestInterface;

beforeEach(function () {
    $this->subject = $this->createFormRequest(
        PageUpdateRequest::class
    );
});

arch('it implements the expected interface')
    ->expect(PageUpdateRequest::class)
    ->toImplement(RequestInterface::class);

test('rules returns ok', function () {
    $actual = $this->subject->rules();

    $this->assertValidationRules([
        'title' => [
            'required',
            'string',
            'max:255',
        ],
        'subtitle' => [
            'nullable',
            'string',
            'max:255',
        ],
        'content' => [
            'nullable',
            'string',
            'max:5120',
        ],
        'metaTitle' => [
            'nullable',
            'string',
            'max:255',
        ],
        'metaDescription' => [
            'nullable',
            'string',
            'max:255',
        ],
        'inSitemap' => [
            'required',
            'boolean',
        ],
    ], $actual);
});
