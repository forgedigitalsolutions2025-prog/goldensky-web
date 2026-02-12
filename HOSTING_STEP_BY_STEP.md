# Step-by-step: Put your web app online (no experience needed)

This guide gets your Golden Sky web app on the internet using **DigitalOcean** and your **Hostinger domain**. You only need to follow the steps in order.

---

## What you’ll need before starting

- [ ] A **DigitalOcean** account (free to sign up: [digitalocean.com](https://www.digitalocean.com))
- [ ] A **Hostinger** account (you already have the domain)
- [ ] Your **domain name** (e.g. `goldenskyhotel.com`)
- [ ] Your web app code in a **GitHub** account (we’ll set this up in Step 1)

---

## Part 1: Get your code on GitHub

GitHub is where your code will live so DigitalOcean can use it.

### Step 1.1: Create a GitHub account (if you don’t have one)

1. Go to [github.com](https://github.com) and click **Sign up**.
2. Enter email, password, and username. Finish signing up.

### Step 1.2: Install GitHub Desktop (easiest way to use GitHub)

1. Go to [desktop.github.com](https://desktop.github.com) and download **GitHub Desktop**.
2. Install it and open it. Sign in with your GitHub account when asked.

### Step 1.3: Put your Web application folder on GitHub

1. On your computer, find the folder: **Web application** (the one that has `artisan`, `composer.json`, and a `public` folder inside it).
2. In **GitHub Desktop**:  
   - Click **File** → **Add local repository**.  
   - If it says “this directory does not appear to be a Git repository”, click **create a repository** and choose that **Web application** folder as the path. Name it e.g. `goldensky-web`. Click **Create repository**.
3. In GitHub Desktop, click **Publish repository** (top right).  
   - Uncheck **Keep this code private** if you’re okay with the repo being public (simplest for this guide).  
   - Click **Publish repository**.
4. Your code is now on GitHub. Remember your **username** and **repository name** (e.g. `yourusername/goldensky-web`).

---

## Part 2: Create the app on DigitalOcean

DigitalOcean will run your Laravel app on the internet.

### Step 2.1: Sign up and open App Platform

1. Go to [digitalocean.com](https://www.digitalocean.com) and sign up (or log in).
2. You may need to add a payment method (card). DigitalOcean has a small free credit for new accounts.
3. In the top menu, click **Apps**, then **Create App**.

### Step 2.2: Connect GitHub

1. On “Choose your source”, select **GitHub**.
2. If asked, click **Authorize DigitalOcean** and allow access to your GitHub account.
3. Choose your **GitHub account** and the **repository** you published (e.g. `goldensky-web`).
4. Leave **Branch** as `main` (or whatever branch has your code).  
5. If your Laravel app is **inside a subfolder** of the repo (e.g. the repo has a folder called `Web application` and inside that you have `artisan`, `composer.json`, `public`), set **Source Directory** to that folder name (e.g. `Web application`). If `composer.json` is in the root of the repo, leave Source Directory empty.  
6. Click **Next**.

### Step 2.3: Let DigitalOcean detect your app

1. It should detect a **PHP** or **Web Service**.  
2. **Resource type:** leave as **Web Service**.  
3. **Run Command:** you can use:  
   `php artisan serve --host=0.0.0.0 --port=8080`  
4. **HTTP Port:** `8080`.  
5. Click **Next**.

### Step 2.4: Choose size and region

1. **Size:** leave the smallest (Basic) – that’s enough to start.  
2. **Region:** pick one close to you or your guests (e.g. New York, London, Bangalore).  
3. Click **Next**.

### Step 2.5: Add environment variables (.env on the cloud)

Your app needs settings (like database and API URLs). DigitalOcean will store them as “Environment Variables”.

1. On the **Environment Variables** screen, click **Edit** or **Add** and add these **one by one** (name = Variable Name, value = Value):

   | Variable Name       | Value (you change these) |
   |---------------------|---------------------------|
   | `APP_ENV`           | `production`              |
   | `APP_DEBUG`         | `false`                   |
   | `APP_URL`           | `https://YOURDOMAIN.com` (use your real Hostinger domain, e.g. `https://goldenskyhotel.com`) |
   | `APP_KEY`           | Generate one: on your computer open Terminal/Command Prompt, go to your Web application folder, run `php artisan key:generate --show` and paste the long key here. |
   | `ADMIN_PASSWORD`    | A strong password you choose (for the admin panel at `/admin/login`). |
   | `DB_CONNECTION`     | `mysql`                   |
   | `DB_HOST`           | Your database host (e.g. from DigitalOcean Managed Database or Hostinger – ask your host for “MySQL host”). |
   | `DB_PORT`           | `3306` (or the port they give you) |
   | `DB_DATABASE`       | Your database name        |
   | `DB_USERNAME`       | Your database user        |
   | `DB_PASSWORD`       | Your database password   |
   | `API_BASE_URL`      | Your backend API URL without `/api/v1` (e.g. `https://whale-app-wcsre.ondigitalocean.app`) |
   | `BACKEND_API_URL`   | Same backend + `/api/v1` (e.g. `https://whale-app-wcsre.ondigitalocean.app/api/v1`) |
   | `GOOGLE_CLIENT_ID`  | (If you use Google login) From Google Cloud Console |
   | `GOOGLE_CLIENT_SECRET` | (If you use Google login) From Google Cloud Console |
   | `GOOGLE_REDIRECT_URI`  | `https://YOURDOMAIN.com/auth/google/callback` (replace YOURDOMAIN with your real domain) |

2. If you don’t have a database yet, you can add **DigitalOcean Managed Database** in the same project (Add Resource → Database), then use the connection details it gives you for `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.

3. Click **Next**, then **Create Resources** (or **Launch**). DigitalOcean will build and run your app. This can take a few minutes.

### Step 2.6: Get your temporary URL

1. When the app is running, DigitalOcean will show a URL like:  
   `https://your-app-xxxxx.ondigitalocean.app`  
2. Open that URL in your browser. You should see your Golden Sky website.  
3. This is your app’s “default” address. Next we’ll connect your own domain to it.

---

## Part 3: Connect your Hostinger domain

You’ll tell the internet: “When someone goes to yourdomain.com, send them to the DigitalOcean app.”

### Step 3.1: Add the domain in DigitalOcean

1. In DigitalOcean, open your **App** (Apps → click your app).
2. Go to **Settings** → **Domains** (or **Components** → your web service → **Domains**).
3. Click **Add Domain**.
4. Type your domain: e.g. `yourdomain.com` or `www.yourdomain.com` (use the one you want people to type).
5. DigitalOcean will show a **CNAME target**, e.g. `your-app-xxxxx.ondigitalocean.app`. **Copy this** – you’ll use it at Hostinger.

### Step 3.2: Point your domain at Hostinger to DigitalOcean

1. Log in to [hostinger.com](https://www.hostinger.com) and go to **Domains** (or **hPanel**).
2. Find your domain and open it. Look for **DNS Zone** or **Manage DNS** or **Nameservers / DNS**.
3. You need to add a **CNAME** record:
   - **Type:** CNAME  
   - **Name:** `www` (if you want people to use `www.yourdomain.com`)  
     - Or if the instructions say “leave blank for root”, you might use `@` or leave Name blank for `yourdomain.com`.  
   - **Target / Points to:** paste the **CNAME target** from DigitalOcean (e.g. `your-app-xxxxx.ondigitalocean.app`).  
   - **TTL:** leave default (e.g. 3600).  
4. **Save** the record.
5. For the **root** domain (`yourdomain.com` without www): some hosts want an **A** record instead of CNAME. If DigitalOcean gave you an **IP address** in the domain settings, add an **A** record: Name `@`, Value = that IP. If not, you can often set a “Redirect” in Hostinger so `yourdomain.com` redirects to `www.yourdomain.com` (which uses the CNAME).

### Step 3.3: Wait and then set the domain in the app

1. **Wait 10–60 minutes** (sometimes up to a few hours) for the internet to update. This is called “DNS propagation”.
2. In DigitalOcean, in your app’s **Domains** section, make sure your domain (e.g. `www.yourdomain.com`) is added and marked as active.
3. DigitalOcean will automatically get an **SSL certificate** (the padlock) for your domain once DNS is correct.

### Step 3.4: Use your domain in the app

1. In DigitalOcean, go to your app → **Settings** → **App-Level Environment Variables** (or the env vars you added earlier).
2. Set **APP_URL** to your real address:  
   `https://www.yourdomain.com` (or `https://yourdomain.com` if that’s what you use).  
3. If you use Google login, set **GOOGLE_REDIRECT_URI** to:  
   `https://www.yourdomain.com/auth/google/callback`  
4. Save. The app may redeploy once; that’s normal.

---

## Part 4: Check that everything works

1. Open your browser and go to **https://www.yourdomain.com** (or your domain).
2. You should see your Golden Sky site with the padlock (HTTPS).
3. Try: **Home**, **Rooms**, **Menu**, **Book**, **Login**.
4. Try the **admin panel**: go to `https://www.yourdomain.com/admin/login` and log in with the **ADMIN_PASSWORD** you set in Step 2.5.

If something doesn’t work:

- **Blank or error page:** Check DigitalOcean app **Logs** (Runtime Logs) for errors. Make sure every env variable (especially `APP_KEY`, `DB_*`, `APP_URL`) is set.
- **Domain not loading:** Wait a bit longer for DNS, and double-check the CNAME (and A record if you added one) at Hostinger.
- **Admin login says “set ADMIN_PASSWORD”:** Add the `ADMIN_PASSWORD` env var in DigitalOcean and redeploy.

---

## Quick reference

| Step | Where | What you do |
|------|--------|-------------|
| 1 | GitHub | Put your “Web application” folder in a repo and publish it. |
| 2 | DigitalOcean | Create App → connect GitHub → set Run Command & port → add env vars → deploy. |
| 3 | Hostinger | Add CNAME (and A if needed) so your domain points to the DigitalOcean app URL. |
| 4 | DigitalOcean | Set APP_URL (and GOOGLE_REDIRECT_URI) to your real domain; check admin login. |

---

## Need help?

- **DigitalOcean:** [docs.digitalocean.com](https://docs.digitalocean.com) → search “App Platform”.
- **Hostinger:** Their support or help articles for “DNS” or “point domain to external host”.
- **Your app:** All production settings are in **HOSTING.md** and **.env.production.example** in the same folder as this file.

You’re done when you can open your domain in a browser and see your site and log in to the admin panel.
