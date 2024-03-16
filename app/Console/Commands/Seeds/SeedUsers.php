<?php

namespace App\Console\Commands\Seeds;

use App\Console\Commands\AppCommand;
use App\Models\User;
use Throwable;

final class SeedUsers extends AppCommand
{
    private const TABLE_HEADINGS = ['count', 'id', 'email'];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:users {count=1 : The number of users to seed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the users table with the specified number of records';

    /** @var array<int, array<int, string>> */
    private array $table_data = [];

    /** Execute the console command. */
    public function handle(): int
    {
        $this->handleInitialization('Seeding ' . $this->argument('count') . ' user records');
        $count = strval($this->argument('count'));

        $this->withProgressBar(range(1, $this->argument('count')), function ($i) use ($count) {
            try {
                $user = User::factory()->create();

                if ($this->option('verbose')) {
                    $this->table_data[] = [strval($i) . '/' . $count, $user->id, $user->email];
                }
            } catch (Throwable $exception) {
                return $this->handleError($exception->getMessage());
            }
        });

        if ($this->option('verbose')) {
            $this->newLine();
            $this->printTable(self::TABLE_HEADINGS, $this->table_data);
        }

        return $this->handleSuccess('Seeded ' . $count . ' user records, users table now has ' . User::count() . ' records in total');
    }
}
