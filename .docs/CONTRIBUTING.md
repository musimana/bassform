# CONTRIBUTING

PRs are welcome, all branches should follow the process laid out on this page.

## Process

1. [Install the project](INSTALL.md) if you haven't done so already
2. Create a new branch
3. Code! :)
    * See the [project CLI docs](CONSOLE.md) for info on commonly used commnds
4. Test the changes
    * See the [testing docs](TESTING.md) for info on one-time set-up & advanced use cases
5. Commit, push & open a pull request detailing your changes, inline with the guidance below

## Guidelines

The following guidelines should be observed for all pull requests.

* Send a coherent commit history, making sure each individual commit in your pull request is meaningful.
* You may need to [rebase](https://git-scm.com/book/en/v2/Git-Branching-Rebasing) to avoid merge conflicts,
or tidy up the history.

## Code Standard Checks

Each of the following commands must complete without errors for a PR to be considered for merging.
If any command fails, all commands should be re-run in turn following any action necessary to resolve the reported issues.

Run the project's linters with:

```sh
$ npm run lint
# > lint...
```

Run the project's static analysis tests with:

```sh
$ composer test:types
# > ./vendor/bin/phpstan analyse...
```

Run the tests configured in the project's [PHPUnit config](phpunit.xml) with:

```sh
$ php artisan test
# PASS  Tests\Unit\App\...
```

Run the browser tests configured in the project's [PHPUnit Dusk config](phpunit.dusk.xml) with:

```sh
$ php artisan dusk
# DevTools listening on...
```

See the [testing docs](TESTING.md) for first time set-up instructions & more info on running the project's tests.

---

|Prev                                                                  |                                                                   Next|
|:---------------------------------------------------------------------|----------------------------------------------------------------------:|
|[<<< Project CLI Commands <<<](CONSOLE.md) ...........................|................................... [>>> Running Tests >>>](TESTING.md)|
