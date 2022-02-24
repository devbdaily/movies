# Movies

Movie collection web app

## Dev Startup

This project is making use of [Laravel Sail](https://laravel.com/docs/9.x/sail)
for its development environment. The documentation below was lifted from the Sail
documentation and is provided below for convenience.

You will need to install composer dependencies in order to use sail. If you do
not have composer installed locally, you can use docker to do it:

```sh
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

Before starting up the containers, copy `.env.example` to `.env` and make any
changes you might want to the ENV variables.

To start up the application's containers, use the following command:

```sh
vendor/bin/sail up -d
```

Finally, run the following to set up your `APP_KEY` variable:

```sh
vendor/bin/sail artisan key:generate
```

You should now be able to visit http://localhost and see the site.

To stop the sail containers:

```sh
vendor/bin/sail stop
```
