# Google OAuth Setup Guide

## Overview
This guide will help you set up Google Sign-In for your web application.

## Step 1: Create Google Cloud Project

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Click "Select a project" → "New Project"
3. Enter project name: "Golden Sky Hotel"
4. Click "Create"

## Step 2: Enable Google+ API

1. In the Google Cloud Console, go to **APIs & Services** → **Library**
2. Search for "Google+ API"
3. Click on it and click "Enable"

## Step 3: Configure OAuth Consent Screen

1. Go to **APIs & Services** → **OAuth consent screen**
2. Select **External** (for public users)
3. Click "Create"
4. Fill in the required fields:
   - **App name**: Golden Sky Hotel & Wellness
   - **User support email**: Your email
   - **Developer contact email**: Your email
5. Click "Save and Continue"
6. Skip **Scopes** (click "Save and Continue")
7. Skip **Test users** (click "Save and Continue")
8. Click "Back to Dashboard"

## Step 4: Create OAuth Credentials

1. Go to **APIs & Services** → **Credentials**
2. Click "**+ Create Credentials**" → "**OAuth client ID**"
3. Select **Application type**: "Web application"
4. **Name**: "Golden Sky Hotel Web App"
5. **Authorized JavaScript origins**:
   - Add: `http://localhost:8000`
   - Add: `http://127.0.0.1:8000`
   - (Later add your production URL)
6. **Authorized redirect URIs**:
   - Add: `http://localhost:8000/auth/google/callback`
   - Add: `http://127.0.0.1:8000/auth/google/callback`
   - (Later add your production callback URL)
7. Click "Create"
8. **Copy the Client ID and Client Secret** (you'll need these)

## Step 5: Update .env File

Add these lines to your `.env` file:

```env
GOOGLE_CLIENT_ID=your-client-id-here.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=your-client-secret-here
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

Replace `your-client-id-here` and `your-client-secret-here` with the values from Step 4.

## Step 6: Clear Config Cache

```bash
php artisan config:clear
```

## Step 7: Test Google Sign-In

1. Go to http://127.0.0.1:8000/login
2. Click "Sign in with Google"
3. Select your Google account
4. Grant permissions
5. You'll be logged in automatically!

## For Production

When deploying to production:

1. Go back to Google Cloud Console
2. Add your production URLs to:
   - Authorized JavaScript origins: `https://yourhotel.com`
   - Authorized redirect URIs: `https://yourhotel.com/auth/google/callback`
3. Update `.env` with production URL:
   ```env
   GOOGLE_REDIRECT_URI=https://yourhotel.com/auth/google/callback
   ```

## Features

- ✅ One-click sign-in with Google account
- ✅ No password needed
- ✅ Email automatically verified (comes from Google)
- ✅ Secure OAuth 2.0 authentication
- ✅ Works on both Login and Register pages

## Troubleshooting

**Error: "redirect_uri_mismatch"**
- Make sure the redirect URI in Google Console exactly matches your app URL
- Check for http vs https
- Clear config cache: `php artisan config:clear`

**Error: "invalid_client"**
- Double-check your Client ID and Client Secret in `.env`
- Make sure there are no extra spaces
- Clear config cache

**Error: "Access blocked: This app's request is invalid"**
- Complete the OAuth consent screen configuration
- Add authorized domains in Google Console

## Security Notes

- Keep your Client Secret secure
- Never commit it to Git
- Use environment variables in production
- Regularly rotate credentials

## Support

For issues with Google OAuth setup, visit:
- [Google OAuth Documentation](https://developers.google.com/identity/protocols/oauth2)
- [Laravel Socialite Documentation](https://laravel.com/docs/10.x/socialite)














































































