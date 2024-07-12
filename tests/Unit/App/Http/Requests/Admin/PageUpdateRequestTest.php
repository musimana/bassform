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

    $this->assertExactValidationRules([
        'blocks' => [
            'nullable',
            'max:5120',
        ],
        'title' => [
            'required',
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
        'webpageStatusId' => [
            'required',
            'integer',
            'max:2',
        ],
    ], $actual);
});
