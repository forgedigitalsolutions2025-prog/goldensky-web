# Hosting checklist – Golden Sky Web Application

Do these before and when deploying to production.

---

## 1. Before first deploy (on your machine or CI)

- Ensure `.env` is in `.gitignore` (it is) and never commit real `.env` or secrets.
- Use `.env.production.example` as the template for the server (copy to `.env` on the server and fill in).

---

## 2. On the server – create `.env`

```bash
cd /path/to/your/app
cp .env.production.example .env
# Edit .env and set every value (see below).
php artisan key:generate
```

**Required in `.env`:**

| Variable | Example / note |
|----------|-----------------|
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_URL` | `https://your-domain.com` |
| `APP_KEY` | (from `php artisan key:generate`) |
| `ADMIN_PASSWORD` | **Required.** Strong password for `/admin/login`. Admin login is blocked until this is set. |
| `DB_*` | Production database credentials |
| `API_BASE_URL` | Your backend base URL (no `/api/v1`) |
| `BACKEND_API_URL` | Your backend URL including `/api/v1` |
| `GOOGLE_REDIRECT_URI` | `https://your-domain.com/auth/google/callback` (or use `"${APP_URL}/auth/google/callback"`) |
| Mail, Google OAuth | Production mail and OAuth credentials |

**HTTPS:** If `APP_URL` is `https://...`, session cookies are sent only over HTTPS automatically. You can set `SESSION_SECURE_COOKIE=true` explicitly if you want.

---

## 3. On the server – after `.env` is ready

```bash
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link
php artisan migrate --force
```

Ensure the web server user can write to `storage/` and `bootstrap/cache/`.

Point the document root to `/public` (Laravel’s entry point).

---

## 4. Optional

- **Multiple servers:** Use `SESSION_DRIVER=database` or `redis` and configure the same store for all app servers.
- **Logging:** Set `LOG_CHANNEL` and `LOG_LEVEL` in `.env` if needed.
- **Queue / scheduler:** If you add queues or `schedule:run`, configure a cron job or process manager on the server.
