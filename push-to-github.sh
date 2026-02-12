#!/bin/bash
# Push this Web application to https://github.com/forgedigitalsolutions2025-prog/goldensky-web
# Run from this folder (Web application) in Terminal: bash push-to-github.sh

set -e
REPO_URL="https://github.com/forgedigitalsolutions2025-prog/goldensky-web.git"

if [ ! -f "artisan" ] || [ ! -f "composer.json" ]; then
  echo "Run this script from the Web application folder."
  exit 1
fi

# Longer timeouts to avoid HTTP 408 on large push
git config http.postBuffer 524288000
git config http.lowSpeedLimit 1000
git config http.lowSpeedTime 600

if [ ! -d ".git" ]; then
  git init
  git remote add origin "$REPO_URL"
  git add -A
  git commit -m "Initial commit: Golden Sky Hotel & Wellness web application"
  git branch -M main
  git push -u origin main
else
  # If you already committed but push failed: remove heavy runtime files from the commit
  git rm -r --cached storage/framework/sessions storage/framework/views storage/logs 2>/dev/null || true
  git add -A
  git status
  if ! git diff --cached --quiet 2>/dev/null; then
    git commit -m "Initial commit: Golden Sky Hotel & Wellness web application" || git commit --amend -m "Initial commit: Golden Sky Hotel & Wellness web application" --no-edit
  fi
  git branch -M main
  git push -u origin main
fi

echo "Done. Check: https://github.com/forgedigitalsolutions2025-prog/goldensky-web"
