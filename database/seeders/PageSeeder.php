<?php

namespace Database\Seeders;

use App\Models\Page;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class PageSeeder extends Seeder
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
                Page::factory()->create([
                    'slug' => $seed['slug'] ?? null,
                    'title' => $seed['title'] ?? null,
                    'subtitle' => $seed['subtitle'] ?? null,
                    'content' => $seed['content'] ?? null,
                    'meta_title' => $seed['meta_title'] ?? null,
                    'meta_description' => $seed['meta_description'] ?? null,
                    'meta_keywords' => $seed['meta_keywords'] ?? null,
                ]);
            }
        }
    }
}
