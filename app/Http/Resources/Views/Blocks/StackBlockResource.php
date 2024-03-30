<?php

namespace App\Http\Resources\Views\Blocks;

use App\Http\Resources\Formatters\LaravelVersionFormatterResource;
use App\Http\Resources\Formatters\PhpVersionFormatterResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;

final class StackBlockResource implements ConstantItemInterface
{
    /**
     * Get the content array for the app's stack content block.
     *
     * @return array<string, string>
     */
    public function getItem(): array
    {
        $laravel_version = (new LaravelVersionFormatterResource)->getValue();

        $php_version = (new PhpVersionFormatterResource)->getValue();

        $php_delimiter_position = strrpos(PHP_VERSION, '.');
        $php_version = $php_delimiter_position
            ? substr(PHP_VERSION, 0, $php_delimiter_position) . '.x'
            : PHP_VERSION;

        $techs = [
            [
                'name' => '<strong>V</strong>ue v3.x',
                'url' => 'https://vuejs.org/',
                'role' => 'Client-side framework',
            ],
            [
                'name' => '<strong>I</strong>nertia v1.x',
                'url' => 'https://inertiajs.com/',
                'role' => 'Build tool',
            ],
            [
                'name' => '<strong>L</strong>aravel v' . $laravel_version,
                'url' => 'https://laravel.com/',
                'role' => 'Server-side framework',
            ],
            [
                'name' => '<strong>T</strong>ailwind v3.x',
                'url' => 'https://tailwindcss.com/docs',
                'role' => 'CSS framework',
            ],
        ];

        $li_elements_string = '';

        foreach ($techs as $tech) {
            $li_elements_string .= '<li><a href="' . $tech['url'] . '" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center hover:text-gray-900 dark:hover:text-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100">'
                . '<span style="display: inline-block;" class="font-mono w-48">' . $tech['name'] . '</span></a><em>' . $tech['role'] . '</em></li>';
        }

        return [
            'html' => implode('', [
                '<h3 class="w-full mb-4 font-semibold text-sm text-gray-950 dark:text-gray-100 uppercase tracking-widest">Stack</h3><ul class="list-disc ml-8 mb-8">',
                $li_elements_string,
                '</ul><p>Running on PHP v' . $php_version . '</p>',
            ]),
        ];
    }
}
