# INSTALLING THE PROJECT

## Requirements

* [Composer](https://getcomposer.org/download)
* [Git](https://git-scm.com/downloads)
* [Node.js](https://nodejs.org/en/download) with NPM

### Windows Only (Pre-installed on MacOS)

* [PHP](https://www.php.net/) running via Apache or Nginx
* [MySQL](https://www.mysql.com/)

The recommended options for this are [Laragon](https://laragon.org/download/index.html) or [Xampp](https://www.apachefriends.org/download.html).

## Installation

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

---

|                                                                                                                                          Next|
|---------------------------------------------------------------------------------------------------------------------------------------------:|
|................................................................................................... [>>> Project CLI Commands >>>](CONSOLE.md)|
