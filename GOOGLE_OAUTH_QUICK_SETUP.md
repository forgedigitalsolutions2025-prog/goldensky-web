# Google OAuth Quick Setup Guide for Localhost

## Step-by-Step Instructions

### Step 1: Go to Google Cloud Console
1. Open your browser and go to: https://console.cloud.google.com/
2. Sign in with your Google account

### Step 2: Create or Select a Project
1. Click on the project dropdown at the top (next to "Google Cloud")
2. Click **"New Project"**
3. Enter project name: **"Golden Sky Hotel"**
4. Click **"Create"**
5. Wait for the project to be created, then select it from the dropdown

### Step 3: Enable Google+ API
1. In the left sidebar, go to **"APIs & Services"** → **"Library"**
2. In the search bar, type: **"Google+ API"** or **"Google Identity Services"**
3. Click on **"Google+ API"** (or **"Google Identity Services"**)
4. Click the **"Enable"** button

### Step 4: Configure OAuth Consent Screen
1. Go to **"APIs & Services"** → **"OAuth consent screen"**
2. Select **"External"** (for public users)
3. Click **"Create"**
4. Fill in the required fields:
   - **App name**: `Golden Sky Hotel & Wellness`
   - **User support email**: Your email (e.g., `dpbthalwatta@gmail.com`)
   - **Developer contact email**: Your email
5. Click **"Save and Continue"**
6. On the **Scopes** page, click **"Save and Continue"** (skip for now)
7. On the **Test users** page, click **"Save and Continue"** (skip for now)
8. Click **"Back to Dashboard"**

### Step 5: Create OAuth Credentials
1. Go to **"APIs & Services"** → **"Credentials"**
2. Click **"+ Create Credentials"** → **"OAuth client ID"**
3. If prompted, select **"Web application"** as the application type
4. Fill in:
   - **Name**: `Golden Sky Hotel Web App (Localhost)`
   - **Authorized JavaScript origins**: Click **"+ Add URI"** and add:
     - `http://localhost:8000`
     - `http://127.0.0.1:8000`
   - **Authorized redirect URIs**: Click **"+ Add URI"** and add:
     - `http://localhost:8000/auth/google/callback`
     - `http://127.0.0.1:8000/auth/google/callback`
5. Click **"Create"**
6. **IMPORTANT**: A popup will appear with your credentials:
   - **Client ID**: Copy this (looks like: `123456789-abc123def456.apps.googleusercontent.com`)
   - **Client secret**: Copy this (looks like: `GOCSPX-abc123def456`)
   - **Save these somewhere safe!** You won't be able to see the secret again

### Step 6: Add Credentials to Your .env File
1. Open your `.env` file in the `Web application` directory
2. Add these lines (replace with your actual credentials):

```env
GOOGLE_CLIENT_ID=your-client-id-here.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=your-client-secret-here
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

**Example:**
```env
GOOGLE_CLIENT_ID=123456789-abc123def456.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=GOCSPX-abc123def456
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

3. Save the `.env` file

### Step 7: Clear Laravel Config Cache
Run this command in your terminal:

```bash
cd "Web application"
php artisan config:clear
```

### Step 8: Test It!
1. Make sure your web server is running: `php artisan serve`
2. Go to: http://localhost:8000/register
3. You should now see the "Sign up with Google" button
4. Click it and test the login!

## Troubleshooting

### Error: "redirect_uri_mismatch"
- Make sure the redirect URI in Google Console **exactly** matches: `http://localhost:8000/auth/google/callback`
- Check for typos, extra spaces, or http vs https
- Clear config cache: `php artisan config:clear`

### Error: "invalid_client"
- Double-check your Client ID and Client Secret in `.env`
- Make sure there are no extra spaces or quotes
- Clear config cache: `php artisan config:clear`

### Error: "Access blocked"
- Make sure you completed the OAuth consent screen setup (Step 4)
- Try adding your email as a test user in OAuth consent screen

### Button Not Showing
- Make sure you added the credentials to `.env`
- Run `php artisan config:clear`
- Check that the credentials are set: `php artisan tinker` then `config('services.google.client_id')`

## For Production (Later)

When you're ready to deploy:
1. Go back to Google Cloud Console → Credentials
2. Edit your OAuth client
3. Add your production URLs:
   - **Authorized JavaScript origins**: `https://www.goldenskyhotelandwellness.com`
   - **Authorized redirect URIs**: `https://www.goldenskyhotelandwellness.com/auth/google/callback`
4. Update `.env` with production URL:
   ```env
   GOOGLE_REDIRECT_URI=https://www.goldenskyhotelandwellness.com/auth/google/callback
   ```

## Need Help?

If you get stuck:
1. Check the full setup guide: `GOOGLE_OAUTH_SETUP.md`
2. Verify your credentials are correct in `.env`
3. Make sure the redirect URI matches exactly
4. Clear config cache after any changes
