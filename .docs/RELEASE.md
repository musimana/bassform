# RELEASE PROCESS

New versions should be named in accordance with the [SemVer](http://semver.org/) conventions.

When releasing a new version of the app, the following should be completed in order:

1) Clear your local repository with `git add . && git reset --hard && git checkout main`
2) On the [GitHub repository](github.com/musimana/bassform), check the contents of github.com/musimana/bassform/compare/{latest_version}...main
3) Checkout the release branch
4) Run the linters locally using: `npm run lint`, if their are errors, a new patch version is required and these steps should be restarted
5) Run the unit tests locally using: `composer test:types`, if their are errors, a new patch version is required and these steps should be restarted
6) Run the type tests locally using: `php artisan test --parallel`, if any tests fail a new patch version is required and these steps should be restarted
7) Run the browser tests locally using: `php artisan dusk`, if any tests fail a new patch version is required and these steps should be restarted
8) Commit the updated [README](../README.md) with the message: `git commit -m "release: vX.X.X"`
9) Push the changes to GitHub

---

|Prev                                                                                                                                          |
|---------------------------------------------------------------------------------------------------------------------------------------------:|
|[<<< Running Tests <<<](TESTING.md) ..........................................................................................................|
