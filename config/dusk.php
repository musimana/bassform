<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Headless Disabled
    |--------------------------------------------------------------------------
    |
    | Determine whether the Dusk command has disabled headless mode.
    |
    | Set the `DUSK_HEADLESS_DISABLED` DotEnv variable to `true` to run the
    | tests in a browser window, or `false` to run them purely from the command
    | line.
    |
    | This option is referenced by both the app & the Laravel Dusk package.
    |
    */

    'headless_disabled' => env('DUSK_HEADLESS_DISABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Pause Length (milliseconds)
    |--------------------------------------------------------------------------
    |
    | The length of time in milliseconds to pause for after each browser
    | wherever the pause method is called by browser tests.
    |
    | Increasing this value can be useful for debugging, or tutorial video
    | generation.
    |
    | This option is only referenced by the app.
    |
    */

    'pause_length' => env('DUSK_PAUSE_LENGTH', 1000),

    /*
    |--------------------------------------------------------------------------
    | Wait Length (seconds)
    |--------------------------------------------------------------------------
    |
    | The length of time in seconds to wait for an action to complete wherever
    | a the pause method is called by browser tests.
    |
    | Increasing this value can be useful for debugging, or tutorial video
    | generation.
    |
    | This option is only referenced by the app.
    |
    */

    'wait_length' => env('DUSK_WAIT_LENGTH', 5),

    /*
    |--------------------------------------------------------------------------
    | Screen Width
    |--------------------------------------------------------------------------
    |
    | The width in pixels of the browser window to be used during browser
    | tests.
    |
    | This option is only referenced by the app.
    |
    */

    'screen_width' => env('DUSK_SCREEN_WIDTH', 1920),

    /*
    |--------------------------------------------------------------------------
    | Screen Height
    |--------------------------------------------------------------------------
    |
    | The height in pixels of the browser window to be used during browser
    | tests.
    |
    | This option is only referenced by the app.
    |
    */

    'screen_height' => env('DUSK_SCREEN_HEIGHT', 1080),

    /*
    |--------------------------------------------------------------------------
    | Start Maximized
    |--------------------------------------------------------------------------
    |
    | Determines if the browser window size should be maximised at the start of
    | each test. Requires headless mode to be disabled to have any effect.
    |
    | Should be set to false for the screen width and height variables to have
    | any effect.
    |
    | This option is referenced by both the app & the Laravel Dusk package.
    |
    */

    'start_maximised' => env('DUSK_START_MAXIMISED', false),

];
