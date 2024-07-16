<?php

namespace Database\Seeders;

use App\Enums\Webpages\WebpageTemplate;
use App\Models\Block;
use App\Models\Page;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

final class PageSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        $seeds = [0];

        try {
            require_once storage_path('app/seeds/pages.php');
        } catch (Exception $exception) {
            Log::error('ERROR ' . $exception->getMessage(), $exception->getTrace());
            echo 'ERROR ' . $exception->getMessage();
        }

        /** @var array<int, mixed> $seeds */
        if ($seeds !== [0]) {
            foreach ($seeds as $seed) {
                $page = Page::factory()->create([
                    'slug' => $seed['slug'] ?? null,
                    'title' => $seed['title'] ?? null,
                    'in_sitemap' => $seed['in_sitemap'] ?? 1,
                    'is_homepage' => $seed['is_homepage'] ?? 0,
                    'meta_description' => $seed['meta_description'] ?? null,
                    'meta_keywords' => $seed['meta_keywords'] ?? null,
                    'template' => $seed['template'] ?? WebpageTemplate::PUBLIC_CONTENT->value,
                ]);

                foreach ($seed['blocks'] ?? [] as $display_order => $block) {
                    Block::factory()->create([
                        'parent_type' => Page::class,
                        'parent_id' => $page->id,
                        'type' => $block['type'],
                        'display_order' => $display_order,
                        'data' => $block['data'] ?? null,
                    ]);
                }
            }
        }
    }
}
