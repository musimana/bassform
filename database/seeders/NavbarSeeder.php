<?php

namespace Database\Seeders;

use App\Models\Navbar;
use App\Models\NavbarItem;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

final class NavbarSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        $seeds = [0];

        try {
            require_once storage_path('app/seeds/navbars.php');
        } catch (Exception $exception) {
            Log::error('ERROR ' . $exception->getMessage(), $exception->getTrace());
            echo 'ERROR ' . $exception->getMessage();
        }

        /** @var array<int, mixed> $seeds */
        if ($seeds !== [0]) {
            foreach ($seeds as $seed) {
                $navbar = Navbar::factory()->create([
                    'title' => $seed['title'],
                ]);

                foreach ($seed['navbar_items'] ?? [] as $display_order => $navbar_item) {
                    $parent = NavbarItem::factory()->create([
                        'navbar_id' => $navbar->id,
                        'title' => $navbar_item['title'],
                        'url' => $navbar_item['url'] ?? null,
                        'display_order' => $display_order,
                    ]);

                    foreach ($navbar_item['subitems'] ?? [] as $key => $subitem) {
                        NavbarItem::factory()->create([
                            'navbar_id' => $navbar->id,
                            'parent_id' => $parent->id,
                            'title' => $subitem['title'],
                            'url' => $subitem['url'],
                            'display_order' => $key,
                        ]);
                    }
                }
            }
        }
    }
}
