<?php

namespace Database\Factories;

use App\Traits\FakesDatabaseValues;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Navbar>
 */
final class NavbarFactory extends Factory
{
    use FakesDatabaseValues;

    /**
     * Define the model's default state.
     *
     * @return array<string, string>
     */
    public function definition(): array
    {
        return [
            'title' => ucwords($this->getFakeString()),
        ];
    }
}
