# Deployment Guide

This guide covers deployment procedures for the Partners Fanati.co MLM platform.

## 📋 Prerequisites

- Docker and Docker Compose installed
- Git configured with repository access
- SSL certificates (managed by Let's Encrypt)
- Domain names configured (partners.fanati.co, sandbox.partners.fanati.co)

## 🚀 Quick Deployment

### Production Deployment

```bash
# Pull latest changes
git pull origin main

# Build and restart containers
docker-compose build
docker-compose up -d

# Check health
curl https://partners.fanati.co/health
curl https://partners.fanati.co/legacy/health
```

### Sandbox Deployment

```bash
# Use the sandbox script
./sandbox.sh up

# Or manually with docker-compose
docker-compose -f docker-compose.yml -f docker-compose.sandbox.yml up -d
```

## 🔄 CI/CD Pipeline

### GitHub Actions Workflow

The deployment is automated via GitHub Actions (`.github/workflows/deploy.yml`):

1. **Trigger**: Push to `main` branch
2. **Build**: Docker images are built with caching
3. **Security Scan**: Trivy scans for vulnerabilities
4. **Deploy**: SSH to production server
5. **Health Check**: Verify services are running

### Manual Deployment

```bash
# SSH to production server
ssh sebastian@185.34.201.34

# Navigate to project
cd /home/sebastian/sites/partners.fanati.co

# Pull latest code
git pull origin main

# Rebuild and deploy
docker-compose down
docker-compose build --no-cache
docker-compose up -d

# Run migrations (when Infinite MLM is installed)
docker exec infinite-mlm php artisan migrate --force
```

## 🔧 Environment Configuration

### Required Environment Variables

#### Infinite MLM (.env)
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://partners.fanati.co

DB_HOST=infinite-mlm-db
DB_PORT=3306
DB_DATABASE=infinite_mlm
DB_USERNAME=infinite_user
DB_PASSWORD=infinitepass2024

REDIS_HOST=partners-redis
REDIS_PORT=6379
```

#### Hybrid MLM (.env)
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://partners.fanati.co/legacy

DB_HOST=hybrid-mlm-db
DB_PORT=3306
DB_DATABASE=hybrid_mlm
DB_USERNAME=hybrid_user
DB_PASSWORD=hybridpass2024
```

## 🌐 Domain Configuration

### DNS Settings

Ensure these DNS records are configured:

```
partners.fanati.co         A    185.34.201.34
sandbox.partners.fanati.co A    185.34.201.34
```

### Nginx Configuration

The main server nginx should proxy to the Docker nginx router:

```nginx
server {
    listen 443 ssl http2;
    server_name partners.fanati.co sandbox.partners.fanati.co;

    ssl_certificate /etc/letsencrypt/live/partners.fanati.co/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/partners.fanati.co/privkey.pem;

    location / {
        proxy_pass http://127.0.0.1:8088;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto https;
    }
}
```

## 📊 Health Monitoring

### Health Check Endpoints

```bash
# Production
curl https://partners.fanati.co/health
curl https://partners.fanati.co/legacy/health

# Sandbox
curl https://sandbox.partners.fanati.co/health
curl https://sandbox.partners.fanati.co/legacy/health

# Local
curl http://localhost:8085/health.php
curl http://localhost:8086/health.php
```

### Expected Response

```json
{
    "status": "healthy",
    "timestamp": "2025-11-17T10:00:00Z",
    "service": "infinite-mlm",
    "checks": {
        "database": {"status": "healthy"},
        "redis": {"status": "healthy"},
        "disk": {"status": "healthy"}
    }
}
```

## 🔐 SSL Certificate Management

### Check Certificate Status

```bash
sudo certbot certificates
```

### Manual Renewal

```bash
sudo certbot renew --webroot -w /home/sebastian/certbot/www
```

### Auto-renewal (via cron)

```cron
0 0,12 * * * certbot renew --quiet --webroot -w /home/sebastian/certbot/www
```

## 📦 Database Management

### Backup Databases

```bash
# Infinite MLM
docker exec infinite-mlm-db mysqldump -u root -p infinite_mlm > backups/infinite_$(date +%Y%m%d).sql

# Hybrid MLM
docker exec hybrid-mlm-db mysqldump -u root -p hybrid_mlm > backups/hybrid_$(date +%Y%m%d).sql
```

### Restore Databases

```bash
# Infinite MLM
docker exec -i infinite-mlm-db mysql -u root -p infinite_mlm < backups/infinite_backup.sql

# Hybrid MLM
docker exec -i hybrid-mlm-db mysql -u root -p hybrid_mlm < backups/hybrid_backup.sql
```

## 🚨 Troubleshooting

### Container Issues

```bash
# Check container status
docker-compose ps

# View logs
docker-compose logs --tail=100 [service-name]

# Restart specific service
docker-compose restart [service-name]

# Rebuild specific service
docker-compose build --no-cache [service-name]
docker-compose up -d [service-name]
```

### Common Issues

1. **403 Forbidden**: Check file permissions
   ```bash
   chmod 644 infinite-mlm/src/public/*.php
   chmod 644 hybrid-mlm/hybridmlm/public_html/fanatics/public/*.php
   ```

2. **Database Connection Failed**: Verify credentials and network
   ```bash
   docker exec [app-container] ping [db-container]
   docker exec [app-container] mysql -h [db-container] -u [user] -p
   ```

3. **SSL Certificate Issues**: Check nginx configuration
   ```bash
   docker exec partners-nginx nginx -t
   docker logs partners-nginx
   ```

## 🔄 Rollback Procedure

If deployment fails:

```bash
# Stop current containers
docker-compose down

# Checkout previous version
git checkout HEAD~1

# Rebuild and start
docker-compose build
docker-compose up -d

# Restore database if needed
docker exec -i [db-container] mysql -u root -p [database] < backups/last_working.sql
```

## 📝 Deployment Checklist

Before deploying to production:

- [ ] All tests passing
- [ ] Environment variables configured
- [ ] Database backed up
- [ ] SSL certificates valid
- [ ] Health checks passing
- [ ] Monitoring alerts configured
- [ ] Rollback plan documented

## 🆘 Support

For deployment issues:
1. Check container logs: `docker-compose logs`
2. Review health endpoints
3. Verify DNS and SSL configuration
4. Check GitHub Actions workflow logs
5. Contact: sebastian@fanati.co