<?php

namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Illuminate\Support\Collection;
use Laravel\Dusk\TestCase as BaseTestCase;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     */
    public static function prepare(): void
    {
        if (!static::runningInSail()) {
            static::startChromeDriver();
        }
    }

    /** Create the RemoteWebDriver instance. */
    protected function driver(): RemoteWebDriver
    {
        $options = (new ChromeOptions)->addArguments(collect([
            $this->shouldStartMaximized() ? '--start-maximized' : '--window-size=' . config('dusk.screen_width') . ',' . config('dusk.screen_height'),
        ])->unless($this->hasHeadlessDisabled(), function (Collection $items) {
            return $items->merge([
                '--disable-gpu',
                '--headless=new',
            ]);
        })->all());

        return RemoteWebDriver::create(
            $_ENV['DUSK_DRIVER_URL'] ?? 'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }

    /**
     * Determine whether the Dusk command has disabled headless mode.
     *
     * Set the `DUSK_HEADLESS_DISABLED` DotEnv variable to true to run the tests
     * in a browser window, or false to run them purely from the command line.
     */
    protected function hasHeadlessDisabled(): bool
    {
        return config('dusk.headless_disabled');
    }

    /**
     * Determine if the browser window should start maximized.
     *
     * Must return false to use variable screensizes.
     */
    protected function shouldStartMaximized(): bool
    {
        return config('dusk.start_maximised');
    }
}
