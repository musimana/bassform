<?php

namespace App\Http\Resources\Views\Public\Content;

use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;
use Illuminate\Foundation\Application;

class PageContentResource implements PageItemInterface
{
    /**
     * Get the content array for the given page's full public resource.
     *
     * @return array<string, string>
     */
    public function getItem(Page $page): array
    {
        return [
            'addendum' => self::getAddendum($page),
            'article' => $page->content,
            'subtitle' => $page->getSubtitle(),
            'bodytext' => '',
            'title' => $page->getTitle(),
        ];
    }

    /** Get the addendum string for the given page. */
    private static function getAddendum(Page $page): string
    {
        $laravel_delimiter_position = strpos(Application::VERSION, '.');
        $laravel_version = $laravel_delimiter_position
            ? substr(Application::VERSION, 0, $laravel_delimiter_position) . '.x'
            : Application::VERSION;

        $php_delimiter_position = strrpos(PHP_VERSION, '.');
        $php_version = $php_delimiter_position
            ? substr(PHP_VERSION, 0, $php_delimiter_position) . '.x'
            : PHP_VERSION;

        return $page->slug === 'about'
            ? '<ul class="list-disc ml-8"><li>Laravel v' . $laravel_version . '</li><li>PHP v' . $php_version . '</li></ul>'
            : '';
    }
}
