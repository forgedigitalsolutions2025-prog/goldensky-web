#!/bin/bash
# Push this Web application to https://github.com/forgedigitalsolutions2025-prog/goldensky-web
# Run from this folder (Web application) in Terminal: bash push-to-github.sh

set -e
REPO_URL="https://github.com/forgedigitalsolutions2025-prog/goldensky-web.git"

if [ ! -f "artisan" ] || [ ! -f "composer.json" ]; then
  echo "Run this script from the Web application folder."
  exit 1
fi

if [ ! -d ".git" ]; then
  git init
  git remote add origin "$REPO_URL"
fi

git config http.postBuffer 524288000
git add -A
git status
if git diff --cached --quiet; then
  echo "Nothing to commit."
else
  git commit -m "Initial commit: Golden Sky Hotel & Wellness web application" || true
fi
git branch -M main
git push -u origin main

echo "Done. Check: https://github.com/forgedigitalsolutions2025-prog/goldensky-web"
