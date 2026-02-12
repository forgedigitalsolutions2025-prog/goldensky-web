# Deploying to DigitalOcean with a Hostinger domain

You have a domain from Hostinger and want to host the Laravel web app on DigitalOcean. Below are two common options and how to connect your domain.

---

## Option A: DigitalOcean App Platform (easiest)

App Platform runs the app for you: build from GitHub/GitLab, automatic HTTPS, no server admin.

### 1. Push your code

- Push the **Web application** folder (or the repo that contains it) to GitHub or GitLab.
- Ensure the **root** of the repo (or the branch you use) has `composer.json`, `artisan`, and the `public/` folder at the expected paths. If your Laravel app lives in a subfolder (e.g. `Web application/`), configure that subfolder as the **Source Directory** in App Platform.

### 2. Create an app in DigitalOcean

1. In [DigitalOcean](https://cloud.digitalocean.com/) go to **Apps** → **Create App**.
2. Connect your GitHub/GitLab and select the repo (and branch).
3. Set **Source Directory** to the folder that contains `composer.json` (leave blank if the repo root is the Laravel app).
4. App Platform will detect PHP. Keep or set:
   - **Build command:** `composer install --no-dev --optimize-autoloader`
   - **Run command:** `heroku-php-apache2 public/` (default when PHP is detected; serves Laravel’s `public/` correctly)
   - **HTTP Port:** `8080`

5. Add **Environment Variables** (click **Edit** next to “Environment Variables” and add at least):
   - `APP_ENV` = `production`
   - `APP_DEBUG` = `false`
   - `APP_URL` = `https://your-app-xxxxx.ondigitalocean.app` (replace with your app URL after first deploy, or your Hostinger domain once DNS is set, e.g. `https://www.goldenskyhotelandwellness.com`)
   - `APP_KEY` = (run `php artisan key:generate --show` locally and paste the value)
   - `ADMIN_PASSWORD` = (choose a strong password for admin login; required in production)
   - `BACKEND_API_URL` = (your backend API base URL, e.g. `https://whale-app-wcsre.ondigitalocean.app/api/v1`)
   - `SESSION_DRIVER` = `file` (so the app does not require MySQL for sessions; otherwise you get "Connection refused" to mysql when loading the site)
   - `SESSION_DOMAIN` = (optional; for custom domain set to `.yourdomain.com` to avoid 419 on admin login, e.g. `.goldenskyhotelandwellness.com`)
   Add `API_BASE_URL`, `GOOGLE_*`, mail vars, etc. if you use them.

6. You do **not** need to add a DigitalOcean database if the app uses only the external backend API.

7. Click **Create app**. You’ll get a URL like `https://your-app-xxxxx.ondigitalocean.app`. After the first deploy, set `APP_URL` to that URL (or to your Hostinger domain once DNS is connected).

**Build command (required)** — install deps, create writable storage dirs, then cache:

`composer install --no-dev --optimize-autoloader && mkdir -p storage/framework/sessions storage/framework/views storage/logs bootstrap/cache && chmod -R 775 storage bootstrap/cache && php artisan storage:link && php artisan route:cache && php artisan view:cache`

**Important:** Do **not** run `php artisan config:cache` in the build. On App Platform, env vars are injected at runtime; caching config at build time bakes in empty values, so `BACKEND_API_URL` and other env vars are ignored and the dashboard stays empty.

### If you see "500 Internal Server Error"

1. **See the real error:** In the app’s **Environment Variables**, set `APP_DEBUG` = `true`. Save, redeploy (Deploy → Deploy or Force Rebuild), then open the app URL again. Laravel will show the actual error and stack trace. Fix that issue, then set `APP_DEBUG` back to `false` and redeploy.
2. **Check logs:** In DigitalOcean → your app → **Runtime Logs** (and **Build Logs**) for PHP errors or stack traces.
3. **Common causes:**
   - **APP_KEY** missing or wrong → add/correct it and redeploy.
   - **APP_URL** wrong → set it to your exact app URL (e.g. `https://kton-app-da23b.ondigitalocean.app`) and redeploy.
   - Storage/cache not writable → ensure the build command creates `storage/framework/sessions`, `storage/framework/views`, `storage/logs`, and `bootstrap/cache` (see build command above).
   - **"No such file or directory" for sessions** → add `mkdir -p storage/framework/sessions storage/framework/views storage/logs bootstrap/cache && chmod -R 775 storage bootstrap/cache` to your build command, then redeploy.

### If you see "419 Page Expired" on admin login (custom domain)

This usually happens when the session cookie or CSRF token doesn’t match the request (e.g. wrong host or scheme behind a proxy). Do the following:

1. **Set `APP_URL` to your live URL**  
   In Environment Variables set:
   - `APP_URL` = `https://www.goldenskyhotelandwellness.com` (use your exact domain with `https://` and `www` if that’s what users use).

2. **Optional but recommended for custom domain: set session domain**  
   So the session cookie is valid for your domain:
   - `SESSION_DOMAIN` = `.goldenskyhotelandwellness.com` (leading dot so it works for both `www` and non-www).

3. **Trust proxies (already in code)**  
   The app’s `TrustProxies` middleware is set to trust all proxies so Laravel uses `X-Forwarded-Host` and `X-Forwarded-Proto` from DigitalOcean’s load balancer. No env var needed.

4. **Redeploy** after changing env vars so the new values are used.

If 419 persists, temporarily set `APP_DEBUG=true`, reproduce the login, and check the Laravel log or error page for session/CSRF errors.

### 3. Use your Hostinger domain

1. In DigitalOcean App Platform: open your app → **Settings** → **Domains** → **Add Domain** → enter your domain (e.g. `goldenskyhotel.com` or `www.goldenskyhotel.com`). DO will show the **CNAME target** (e.g. `your-app-xxxxx.ondigitalocean.app`).
2. In **Hostinger**: go to **Domains** → your domain → **DNS / Name Servers** (or **Manage DNS**).
3. Add a **CNAME** record:
   - **Name:** `www` (for `www.yourdomain.com`) or `@` if your host supports CNAME for root (many use an A record instead).
   - **Target:** the CNAME target from DigitalOcean (e.g. `your-app-xxxxx.ondigitalocean.app`).
4. For the **root** domain (`yourdomain.com` without www), Hostinger often uses an **A** record. In that case, in DigitalOcean get the **IP** of your app (if App Platform exposes one) or use a **redirect** from root to `www`. Alternatively, use Hostinger’s “Redirect” or “Point to IP” and use the IP App Platform gives you (if any). App Platform’s “Add Domain” flow usually tells you exactly what to add.
5. Wait for DNS (5–60 minutes). App Platform will issue HTTPS for your domain once DNS points to DO.

Set `APP_URL` and `GOOGLE_REDIRECT_URI` to `https://your-domain.com` (or `https://www.your-domain.com`) so the app and Google login work correctly.

---

## Option B: DigitalOcean Droplet (VPS)

You get a Linux server; you install Nginx, PHP, Composer, and run Laravel yourself. Full control and document root = `public/`.

### 1. Create a Droplet

- **Image:** Ubuntu 22.04.
- **Plan:** Basic Shared CPU (e.g. $6/mo) is enough to start.
- **Datacenter:** Choose one close to your users.
- Add your SSH key.

### 2. Point Hostinger domain to the Droplet

1. In DigitalOcean: get the **Droplet’s public IP**.
2. In Hostinger DNS for your domain:
   - **A record:** Name `@`, Value = Droplet IP (for `yourdomain.com`).
   - **A record:** Name `www`, Value = Droplet IP (for `www.yourdomain.com`), or use a CNAME to `yourdomain.com` if you prefer.

### 3. Set up the server (Ubuntu)

SSH into the Droplet, then:

```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y nginx php8.2-fpm php8.2-mysql php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip unzip
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

### 4. Deploy the app

- Clone your repo (or upload files) to e.g. `/var/www/goldensky`.
- Put the Laravel app so that `composer.json` and `public/` are inside `/var/www/goldensky` (e.g. if the repo has a “Web application” folder, clone into `/var/www/goldensky` and use that folder as the app root, or clone the whole repo and set the app root to `repo/Web application`).

```bash
cd /var/www/goldensky
cp .env.production.example .env
nano .env   # set APP_URL=https://your-domain.com, ADMIN_PASSWORD, DB_*, API_*, etc.
php artisan key:generate
composer install --no-dev --optimize-autoloader
php artisan config:cache && php artisan route:cache && php artisan view:cache
php artisan storage:link
php artisan migrate --force
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### 5. Nginx site for Laravel

Create a vhost, e.g. `/etc/nginx/sites-available/goldensky`:

```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/goldensky/public;
    index index.php;
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

Then:

```bash
sudo ln -s /etc/nginx/sites-available/goldensky /etc/nginx/sites-enabled/
sudo nginx -t && sudo systemctl reload nginx
```

### 6. HTTPS with Let’s Encrypt (Certbot)

```bash
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

Follow the prompts. Certbot will configure HTTPS and redirect HTTP → HTTPS.

After that, set in `.env`:

- `APP_URL=https://yourdomain.com`
- `SESSION_SECURE_COOKIE=true` (optional; your app already treats https as secure when `APP_URL` is https)

---

## Checklist (either option)

- [ ] Domain DNS at Hostinger points to DigitalOcean (CNAME for App Platform, A for Droplet).
- [ ] `APP_URL` and `GOOGLE_REDIRECT_URI` use your real domain with `https://`.
- [ ] `ADMIN_PASSWORD` set in production env.
- [ ] `APP_DEBUG=false`, `APP_ENV=production`.
- [ ] Database (if used) reachable and `DB_*` set.
- [ ] `API_BASE_URL` / `BACKEND_API_URL` point to your backend (e.g. existing whale-app or another DO service).

Once DNS has propagated and env is correct, the web app is ready to use at your Hostinger domain on DigitalOcean.
