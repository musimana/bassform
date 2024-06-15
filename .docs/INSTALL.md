# INSTALLING THE PROJECT

These instructions cover set-up for a local environment, for details about other environments see the [release docs](RELEASE.md).

All commands listed should be run from the local repo's root directory.

## Requirements

* [Composer](https://getcomposer.org/download)
* [Git](https://git-scm.com/downloads)
* [Node.js](https://nodejs.org/en/download) with NPM

### Windows Only (Pre-installed on MacOS)

* [PHP](https://www.php.net/) running via Apache or Nginx
* [MySQL](https://www.mysql.com/)

The recommended options for this are [Laragon](https://laragon.org/download/index.html) or [Xampp](https://www.apachefriends.org/download.html).

## Installation

### Dependencies

Once the repo is forked and then cloned to a local repository, install the project's dependencies by running the following:

```sh
$ composer i
# Installing dependencies from lock file (including require-dev)...

$ npm i
# up to date, audited... // Exact message depends on the state of the local environment
```

### Environment Configuration

Then create the local [Dotenv](./.env) with:

```sh
$ cp .env.example .env && php artisan key:generate
# INFO  Application key set successfully.
```

Review the properties in the local [Dotenv](./.env) to ensure they are set-up to match the desired environment.

### Database Initialisation

Ensure a local database file exists with:

```sh
$ touch database/database.sqlite
# ... {creates the file if it doesn't exist}
```

Set-up the app's database with the default content found in the [seeds directory](../storage/app/seeds/) with:

```sh
$ php artisan migrate --seed
# INFO  Preparing database...
```

---

|                                                                                                                                          Next|
|---------------------------------------------------------------------------------------------------------------------------------------------:|
|................................................................................................... [>>> Project CLI Commands >>>](CONSOLE.md)|
