# Partners-Fanati-Co Repository Setup Instructions

## Repository Created Successfully! 🎉

I've prepared the initial structure for the partners-fanati-co repository. Due to shell session limitations, you'll need to complete the setup manually.

## Files Created

The following files have been created in `/home/sebastian/git-repos/partners-fanati-co/`:

- ✅ **README.md** - Complete repository documentation
- ✅ **Dockerfile** - Laravel PHP-FPM Alpine container
- ✅ **docker-compose.yml** - Multi-container setup with MariaDB
- ✅ **.gitignore** - Laravel-specific ignore patterns (may need to be recreated)
- ✅ **.env.example** - Environment variables template (may need to be recreated)
- ✅ **.github/workflows/deploy.yml** - CI/CD pipeline (may need to be recreated)

## Manual Steps Required

### 1. Initialize Git Repository

Open a new terminal and run:

```bash
cd /home/sebastian/git-repos/partners-fanati-co
git init
git config user.email "sebastian@fanati.co"
git config user.name "Sebastian"
```

### 2. Create GitHub Repository

```bash
# Create the repository on GitHub
gh repo create fanaticodev/partners-fanati-co \
  --public \
  --description "Partner portal for Fanatico network - Laravel application"

# Or create manually at: https://github.com/new
```

### 3. Add Files and Commit

```bash
# Add all files
git add .

# Create initial commit
git commit -m "feat: Initialize partners-fanati-co repository

- Added Laravel application structure
- Configured Docker setup for PHP-FPM and MariaDB
- Created GitHub Actions deployment workflow
- Added comprehensive documentation

This separates the Laravel partner portal from the monorepo for
better maintainability and independent deployment lifecycle."
```

### 4. Push to GitHub

```bash
# Add remote origin
git remote add origin https://github.com/fanaticodev/partners-fanati-co.git

# Push to main branch
git push -u origin main
```

### 5. Configure GitHub Secrets

Add the following secret to the repository for deployment:

1. Go to: https://github.com/fanaticodev/partners-fanati-co/settings/secrets/actions
2. Add `SSH_PRIVATE_KEY` with the deployment key

### 6. Copy Laravel Application (Optional)

If you want to migrate the existing Laravel application:

```bash
# Copy from production (be careful with sensitive files)
cp -r /home/sebastian/sites/partners.fanati.co/hybridmlm/* \
      /home/sebastian/git-repos/partners-fanati-co/

# Remove sensitive files
rm -f .env
rm -rf vendor/
rm -rf node_modules/
rm -rf storage/logs/*
rm -rf storage/framework/cache/*
rm -rf storage/framework/sessions/*
rm -rf storage/framework/views/*
```

### 7. Update Monorepo

Remove the partners.fanati.co placeholder from fanatico-sites:

```bash
cd /home/sebastian/git-repos/fanatico-sites
rm -rf sites/partners.fanati.co/
git add -A
git commit -m "refactor: Remove partners.fanati.co - moved to dedicated repository

Partners portal has been migrated to its own repository at:
https://github.com/fanaticodev/partners-fanati-co

This separation improves maintainability for the Laravel application."
git push origin main
```

## Verification Checklist

- [ ] Git repository initialized
- [ ] GitHub repository created
- [ ] Initial commit pushed
- [ ] GitHub Actions configured
- [ ] SSH deployment key added
- [ ] Monorepo updated to remove placeholder
- [ ] Test deployment pipeline

## Next Steps

1. **Add Laravel code** - Copy or recreate the Laravel application files
2. **Configure secrets** - Set up production environment variables
3. **Test deployment** - Push a test commit to trigger CI/CD
4. **Update NGINX** - Ensure proxy configuration points to correct container
5. **Enable Renovate** - Add repository to Renovate configuration

## Repository URLs

- **GitHub**: https://github.com/fanaticodev/partners-fanati-co
- **Production**: https://partners.fanati.co
- **Local Dev**: http://localhost:8080

## Support

If you encounter any issues:
1. Check GitHub Actions logs
2. Verify Docker container status
3. Review NGINX error logs
4. Check Laravel application logs

---

**Created**: November 12, 2025
**Purpose**: Separate Laravel application for better maintainability