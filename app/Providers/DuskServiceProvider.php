<?php

namespace App\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\Browser;

class DuskServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /** Register Dusk's browser macros. */
    public function boot(): void
    {
        Browser::macro('getScreenshotFilename', function ($filename_base, $count) {
            return date('Y-m-d') . '_' . str_replace(' ', '_', strtolower(config('app.name')))
                . '/' . config('dusk.screen_width') . 'x' . config('dusk.screen_height')
                . '/' . $filename_base . '_' . $count;
        });

        Browser::macro('screenshotWholePage', function ($filename_base) {
            $this->scrollToTop()->pause(config('dusk.pause_length'));

            $screen_max = ceil($this->script('return document.body.offsetHeight / window.innerHeight')[0]);

            for ($screen = 1; $screen <= $screen_max; $screen++) {
                $this->screenshot($this->getScreenshotFilename($filename_base, $screen))
                    ->pause(config('dusk.pause_length'))
                    ->scrollDownScreenHeight();
            }

            $this->scrollToTop()->pause(config('dusk.pause_length'));

            return $this;
        });

        Browser::macro('scrollToTop', function () {
            $this->script('window.scrollTo(0, 0)');

            return $this;
        });

        Browser::macro('scrollDownScreenHeight', function () {
            $this->script('window.scrollBy(0, window.innerHeight)');

            return $this;
        });

        Browser::macro('scrollToEnd', function () {
            $this->script('window.scrollTo(0, document.body.scrollHeight)');

            return $this;
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
