#!/usr/bin/env bash
# Run the Laravel app on http://127.0.0.1:8000
# Must run from the public directory so server.php can find index.php

cd "$(dirname "$0")/public" || exit 1
echo "Serving at http://127.0.0.1:8000 (document root: public/)"
exec php -S 127.0.0.1:8000 ../vendor/laravel/framework/src/Illuminate/Foundation/resources/server.php
