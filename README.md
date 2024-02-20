# Bassform - VILT SSR

VILT stack template app for PHP 8.2.x created by Musimana. Features include with server-side rendering (SSR) and Larastan, Pest & Dusk test suites.

[Vue3](https://vuejs.org/),
[Inertia](https://inertiajs.com/),
[Laravel 10.x](https://laravel.com/docs),
[Tailwind 3.x](https://tailwindcss.com/docs)

## Getting Started

### Requirements

* [Composer](https://getcomposer.org/download)
* [Node.js](https://nodejs.org/en/download) with NPM

### Installation

Once the repo is forked and then cloned to a local repository, install the project's dependencies by running the following:

```sh
$ composer i
# Installing dependencies from lock file (including require-dev)...

$ npm i
# up to date, audited... // Exact message depends on the state of the local environment

$ php artisan migrate --seed
# INFO  Preparing database...
```

Then create the local [Dotenv](./.env) with:

```sh
$ cp .env.example .env && php artisan key:generate
# INFO  Application key set successfully.
```

Review the properties in the local [Dotenv](./.env) to ensure they are set-up to match the desired environment.

## Compiling & Serving Assets

To compile & serve the assets in development mode run:

```sh
$ npm run dev
# > dev...
```

To compile & serve the assets in production mode run:

```sh
$ npm run build && php artisan inertia:start-ssr
# > build...
```

### Other Project CLI Commnds

```sh
$ npm run lint
# ... {runs the linters}

$ composer test:types
# ... {runs the project's type tests}

$ php artisan test
# ... {runs the project's unit tests}
```

Before the first run of the test suite in a new environment, run the following to create a local test SQLite database:

```sh
$ touch database/database.sqlite
# ... {creates a local ./database/database.sqlite file}
```

## License

The both this app and the Laravel framework are open-source software, licensed under the [MIT license](https://opensource.org/licenses/MIT).
