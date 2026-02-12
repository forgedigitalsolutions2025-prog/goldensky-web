# Running the Laravel web app locally

The error `Failed to open required '/index.php'` happens when the PHP built-in server is started from the wrong directory. Laravel’s router script expects the **current working directory to be the `public` folder**.

## Option 1: Use the serve script (recommended)

From the **Web application** folder run:

```bash
./serve.sh
```

Or with bash explicitly:

```bash
bash serve.sh
```

Then open: **http://127.0.0.1:8000**

## Option 2: Use Artisan (if you have Laravel installed)

From the **Web application** folder:

```bash
php artisan serve
```

## Option 3: Manual PHP server

From the **Web application** folder, start the server with `public` as the working directory:

```bash
cd public && php -S 127.0.0.1:8000 ../vendor/laravel/framework/src/Illuminate/Foundation/resources/server.php
```

**Do not** run `php -S 127.0.0.1:8000` from the Web application root without `-t public` and the router, or from a directory that is not `public`; that leads to the “index.php not found” error.
