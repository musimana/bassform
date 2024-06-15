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

---

|Prev                                                                                                                                          |
|:---------------------------------------------------------------------------------------------------------------------------------------------|
|[<<< Running Tests <<<](TESTING.md) ..........................................................................................................|
