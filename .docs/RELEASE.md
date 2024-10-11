# RELEASE PROCESS

## Versioning Policy

New versions are named in accordance with the [SemVer](http://semver.org/) conventions, and are identified by tagged releases on the repository.
A new tag is created for each release, with the new tag and the title of the release in the format `v1.0.0`, where the digits indicate the SemVer version.
The convention is to use the generated release notes feature, with pre-releases marked as appropriate.

Each merge to main should tagged as a new version on the repo.

### Major Versions & Breaking Changes

Major versions for this OS repo are tied to the major version of Laravel used for the framework and the PHP versions supported by that Laravel version.

Minor versions of this template intentionally include changes to things like the directory structure and available namespaces;
method names, parameters & return types; and front-end templates.
Each minor version is tested to ensure it's stability but no support is provided for updating an existing instance of the template to a later version of it.
The template is provided as is, but without restrictions on how you can use it.

## Production Environment Installation

The specifics of the following depend on your hosting provider but are provided as a loose checklist.

Check correct version of PHP is installed -> see the Laravel deployment docs for standard PHP extensions.

Also check that `Git`, `Composer`; `Node.js`, `npm`, `rsync`; are installed with a sufficient version.

### Installing NVM

Node versions on Linux distributions should be normally be managed with [NVM](https://github.com/nvm-sh/nvm?tab=readme-ov-file#installing-and-updating).

### Environment Configuration

#### DotEnv First Time Steps

* `cp .env.example .env` -> `vim .env` and then update all values, `APP_ENV` must be `production` before next step
* `php artisan key:generate`

### Dependency Installation

* `cd` into the newly created directory and run `composer install --no-dev --optimize-autoloader`
* Install the node packages with `npm install --only=prod`

### Database Set-Up

#### Database First Time Steps

* Create the database with `touch database/database.sqlite`
* Run the migrations with `php artisan migrate --force --seed`

#### Database Standard Steps

* Run any new migrations with `php artisan migrate --force`

### Asset Cache Set-up

For web apps in production environments, it's usually beneficial to set static assets e.g. images, to be cached by browsers.

Example boilerplate for this is provided in the project's [.htaccess](/public/.htaccess).

### Optimisation

* Run `php artisan optimize`
* Restart workers
* Restart FPM

---

|Prev                                                                                                                                          |
|:---------------------------------------------------------------------------------------------------------------------------------------------|
|[<<< Running Tests <<<](TESTING.md) ..........................................................................................................|
