<?php

namespace App\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\Browser;

/**
 * @method string getScreenshotFilename(string $filename_base, string $count_string)
 * @method Browser scrollToTop()
 */
final class DuskServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /** Register Dusk's browser macros. */
    public function boot(): void
    {
        Browser::macro('getScreenshotFilename', function (string $filename_base, string $count_string) {
            return date('Y-m-d') . '_' . str_replace(' ', '_', strtolower(config('app.name')))
                . '/' . config('tests.dusk.screen_width') . 'x' . config('tests.dusk.screen_height')
                . '/' . $filename_base . '_' . $count_string;
        });

        Browser::macro('screenshotWholePage', function (string $filename_base) {
            /** @var Browser $browser */
            $browser = $this;
            $browser->scrollToTop()->pause(config('tests.dusk.pause_length'));

            $screen_max = ceil($browser->script('return document.body.offsetHeight / window.innerHeight')[0]);

            for ($screen = 1; $screen <= $screen_max; $screen++) {
                $browser->screenshot($browser->getScreenshotFilename($filename_base, (string) $screen))
                    ->pause(config('tests.dusk.pause_length'))
                    ->scrollDownScreenHeight();
            }

            $browser->scrollToTop()->pause(config('tests.dusk.pause_length'));

            return $browser;
        });

        Browser::macro('scrollToTop', function () {
            /** @var Browser $browser */
            $browser = $this;
            $browser->script('window.scrollTo(0, 0)');

            return $browser;
        });

        Browser::macro('scrollDownScreenHeight', function () {
            /** @var Browser $browser */
            $browser = $this;
            $browser->script('window.scrollBy(0, window.innerHeight)');

            return $browser;
        });

        Browser::macro('scrollToEnd', function () {
            /** @var Browser $browser */
            $browser = $this;
            $browser->script('window.scrollTo(0, document.body.scrollHeight)');

            return $browser;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return [self::class];
    }
}
