<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

abstract class AppCommand extends Command
{
    private const MAX_LINE_LENGTH = 128;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Non-functional abstract base command class with generic helper methods, for other commands to extend from';

    private float $start_microtime = 0.0;

    /** Execute the console command. */
    public function handle(): int
    {
        return Command::SUCCESS;
    }

    /**
     * Get the string of the time taken to complete the command in seconds and
     * milliseconds.
     */
    public function getCompletionTime(): string
    {
        $microtime = microtime(true) - $this->start_microtime;
        $seconds = intval($microtime);
        $microseconds = $microtime - $seconds;

        return strval($seconds . str_replace('0.', '.', sprintf('%.3f', $microseconds))) . 's';
    }

    /** Print the given list item to the console. */
    public function handleInitialization(string $message = ''): void
    {
        $this->start_microtime = microtime(true);

        $message = strlen($message) > self::MAX_LINE_LENGTH - 10
            ? substr($message, 0, self::MAX_LINE_LENGTH - 8) . '…'
            : $message;

        $this->printConsoleMessage('++++ ' . str_pad($message, self::MAX_LINE_LENGTH - 10) . ' ++++', [], 'question');
        $this->newLine();
    }

    /** Print the given list item to the console. */
    public function handleListItem(string $message = ''): void
    {
        if ($message) {
            $this->line(str_pad('- ' . $message, 6 + strlen($message), ' ', STR_PAD_LEFT));
        }
    }

    /** Print the given notice to the console. */
    public function handleNotice(string $message = ''): void
    {
        if ($message) {
            $this->line('INFO | ' . $message);
            $this->newLine();
        }
    }

    /** Print the given notice to the console, and return FAILURE. */
    public function handleError(string $message = ''): int
    {
        $message = $message ? '✗ ERROR | ' . $message : '✗ ERROR';
        $message = str_replace('ERROR | ERROR | ', 'ERROR | ', $message);

        $this->newLine(2);
        $this->error($message);

        return Command::FAILURE;
    }

    /** Print the given notice to the console, and return SUCCESS. */
    public function handleSuccess(string $message = ''): int
    {
        if ($this->start_microtime || $message) {
            $this->newLine(2);

            $message = $message ? ' | ' . $message : '';
            $completion_time = $this->start_microtime ? ' (' . $this->getCompletionTime() . ')' : '';

            $this->info('✓ COMPLETED' . $completion_time . $message);
        }

        return Command::SUCCESS;
    }

    /** Print the given warning to the console. */
    public function handleWarning(string $message = ''): void
    {
        if ($message) {
            $this->printConsoleMessage(
                str_pad('… WARNING | ' . $message, 16 + strlen($message), ' ', STR_PAD_LEFT),
                [],
                'warn'
            );
        }
    }

    /**
     * Print messages to the console.
     *
     * @param  array<int, string>  $context_messages_array
     */
    public function printConsoleMessage(string $message, array $context_messages_array = [], string $type = 'info'): void
    {
        if (!in_array($type, ['comment', 'error', 'info', 'line', 'question', 'warn'])) {
            return;
        }

        $this->newLine();
        $this->$type($message);

        if ($context_messages_array) {
            $this->newLine();
            array_map(fn ($context_message) => $this->handleListItem($context_message), $context_messages_array);
        }
    }

    /**
     * Print a table to the console.
     *
     * @param  array<int, string>  $headings
     * @param  array<int, array<int, string>>  $data
     */
    public function printTable(array $headings, array $data = []): void
    {
        $this->newLine();
        $this->table($headings, $data);
    }
}
