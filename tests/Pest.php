<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(TestCase::class)->in('Unit');
uses(TestCase::class, RefreshDatabase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

include_once __DIR__ . '/Pest/Expectations/ToHaveCorrectHeaderValues.php';
include_once __DIR__ . '/Pest/Expectations/ToHaveCorrectHtmlBody.php';
include_once __DIR__ . '/Pest/Expectations/ToHaveCorrectHtmlHead.php';
include_once __DIR__ . '/Pest/Expectations/ToHaveCorrectPropsAuth.php';
include_once __DIR__ . '/Pest/Expectations/ToHaveCorrectPropsDetails.php';
include_once __DIR__ . '/Pest/Expectations/ToHaveCorrectSessionValues.php';
include_once __DIR__ . '/Pest/Expectations/ToHaveCorrectXmlSitemapIndex.php';
include_once __DIR__ . '/Pest/Expectations/ToHaveCorrectXmlSitemapPages.php';

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function something()
{
    // ..
}
