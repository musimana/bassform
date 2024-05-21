# PROJECT COMMANDS

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

## Content & Database Seeding

### Seeding Users

To seed test user records, run e.g.:

```sh
> `php artisan seed:users`
# ... {seeds a user record}

> `php artisan seed:users 99`
# ... {seeds 99 user records}
```

---

|Prev                                                                  |                                                                   Next|
|:---------------------------------------------------------------------|----------------------------------------------------------------------:|
|[<<< Installation <<<](INSTALL.md) ...................................|............................... [>>> Contributing >>>](CONTRIBUTING.md)|
