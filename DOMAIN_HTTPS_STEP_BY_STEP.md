# Make Your Golden Sky Site Secure — Step by Step

Your site is secure when people use **https://www.goldenskyhotelandwellness.com**.  
When they type **goldenskyhotelandwellness.com** (no “www”, no “https”), the browser can show “Connection is not fully secure.” This guide fixes that.

---

## Part 1: Use the correct address (do this first)

1. Open your phone or computer browser.
2. In the address bar, type exactly:
   ```
   https://www.goldenskyhotelandwellness.com
   ```
   (Include **https://** and **www** — don’t leave them out.)
3. Press Enter.
4. You should see a **padlock** next to the address and **no** “not fully secure” warning.
5. **Bookmark this address** so you always open the secure version.

---

## Part 2: Redirect “short” address to the secure one (Hostinger)

So when someone types **goldenskyhotelandwellness.com** (no www), they are sent to the secure **www** address.

### 2.1 Log in to Hostinger

1. Go to [https://www.hostinger.com](https://www.hostinger.com).
2. Log in (top right).
3. You should see your account / list of domains.

### 2.2 Open your domain

1. Find **goldenskyhotelandwellness.com** in the list.
2. Click it (or click “Manage” / “Dashboard” for that domain).

### 2.3 Add a redirect

1. Look for a section named **“Redirects”** or **“Domain redirect”** or **“URL redirect”**.
   - It might be under **“Advanced”** or **“DNS / Nameservers”** or on the main domain page.
2. Click **“Create redirect”** or **“Add redirect”** (or similar).
3. Set:
   - **From:** `goldenskyhotelandwellness.com` (or leave “@” if that means “root domain”).
   - **To:** `https://www.goldenskyhotelandwellness.com`
   - **Type:** **Permanent (301)** if you see that option.
4. Save.

After DNS updates (a few minutes to an hour), anyone opening **goldenskyhotelandwellness.com** will be sent to **https://www.goldenskyhotelandwellness.com** and see the padlock.

---

## Part 3: If you can’t find “Redirects” in Hostinger

Hostinger’s menu changes sometimes. Try:

1. **Domains** → your domain → **Redirects**.
2. Or **Websites** → your site → **Advanced** → **Redirects**.
3. Or open **“DNS / Zone”** or **“Manage DNS”** and look for a **“Redirect”** or **“Forwarding”** tab.

If you see **“Forward domain”** or **“Point domain to”**, use that and set the target to:
`https://www.goldenskyhotelandwellness.com`.

---

## Quick recap

| What you do | Result |
|-------------|--------|
| Always open **https://www.goldenskyhotelandwellness.com** | Padlock, secure. |
| Set redirect: goldenskyhotelandwellness.com → https://www... | Anyone typing the short address gets the secure site. |

No coding needed — just use the correct URL and add the redirect in Hostinger. If a step doesn’t match your screen (e.g. button names), tell me what you see and we can adjust the steps.
