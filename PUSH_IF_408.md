# If push fails with HTTP 408 (timeout)

Push from **your Mac** in a stable network (not from Cursor’s environment). The repo is large (~85MB history or many files), so GitHub may timeout from some networks.

## Option 1: Normal push

```bash
cd "/path/to/Web application"
git config http.postBuffer 524288000
git config http.lowSpeedLimit 1000
git config http.lowSpeedTime 600
git push -u origin main
```

## Option 2: Single-commit push (avoids large history)

If the normal push still times out, push only the current files as one commit (no old history):

```bash
cd "/path/to/Web application"
git checkout --orphan temp-main
git add -A
git commit -m "Golden Sky Hotel & Wellness web application"
git push origin temp-main
```

Then on GitHub:

- Either set **temp-main** as the default branch (Settings → Default branch → temp-main), or  
- Locally run: `git push origin temp-main:main --force` (overwrites `main` on GitHub with this single commit).

After a successful push, you can delete the orphan branch locally if you want:

```bash
git checkout main
git branch -D temp-main
```

Repo URL: **https://github.com/forgedigitalsolutions2025-prog/goldensky-web**
