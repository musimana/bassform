# RUNNING THE TEST SUITE

The test suite has three levels: Type, Unit & Integration.

*Type* tests - also known as Static Analysis - relate to [PHPStan](https://phpstan.org/) tests,
served by [Larastan](https://github.com/larastan/larastan) for this project.

```sh
$ compser test:types
# ... {runs the type tests for the project}
```

*Unit* tests relate to PHPUnit based tests, as configured by the [PHPUnit config file](/phpunit.xml)

```sh
$ php artisan test
# ... {runs the unit tests for the project}
```

*Integration* tests for this project consist of [Dusk] browser tests.

```sh
$ php artisan dusk
# ... {runs the integration tests for the project}

# If the output begins with 'Warning: TTY mode is not supported on {local OS} platform.',
# use the following to avoid the warning & display colours in the CLI output:

$ php artisan dusk --without-tty --colors=always
# ... {runs the integration tests for the project}
```

Whether the tests use Dark Mode is dependent on the relevant OS settings.

## One Time Set-Up

### Unit Tests Set-Up

Run the following to create a `database.sqlite` file for unit tests:

```sh
$ touch database/database.sqlite
# ... {creates the database}
```

### Integraion Tests Set-Up

Make sure the `APP_URL` variable in the [DotEnv](/.env) file matches the URL used to access the app in a browser locally.

You can set-up an environment specific DotEnv for testing with:

```sh
$ cp .env.example .env.dusk.{ENV}
#
# ... {copies the example DotEnv file to a live copy ignoring values in any other DotEnv file
#        where {ENV} is the type of the local environment
#            e.g. `.env.dusk.local`, `.env.dusk.testing`}
```

## Common Test Commands

### Type Tests

*NB:* If a local `phpstan.neon` file exists for experimentation,
use `composer stan -c phpstan.dist.neon` to run the type tests with the  project's committed config file

### Unit Tests

```sh
$ php artisan test --parallel
#
# ... {runs all tests in parallel}

$ php artisan test --retry
#
# ... {runs any tests that failed on the last run first for each test suite}

$ php artisan test --profile --compact
#
# ... {tests run with minimal reporting because of --compact}
# Top 10 slowest tests:
# ... {shows details about the time taken by those tests because of --profile}

$ php artisan test --filter Year2023 --bail
#
# PASS  Tests\Feature\App\...
# ... {acts the same as PHPUnit's `--stop-on-error --stop-on-failure` because of --bail}

$ php artisan test --filter "example.+2023 Day 1 Part 1"
#
# PASS  Tests\Feature\App\...
```

### Integration Tests

Run the browser test suite with:

```sh
$ php artisan dusk
# ... DevTools listening on ws:...
# ... {runs the browser i.e. integration tests for the project}

$ php artisan dusk --stop-on-error --stop-on-failure
# ... DevTools listening on ws:...
# ... {long-form version of --bail}
```

---

|Prev                                                                  |                                                                   Next|
|:---------------------------------------------------------------------|----------------------------------------------------------------------:|
|[<<< Contributing <<<](CONTRIBUTING.md) ..............................|........................................ [>>> Releases >>>](RELEASE.md)|
