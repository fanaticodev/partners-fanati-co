# SSL/HTTPS Setup Documentation

This document details the SSL certificate configuration for partners.fanati.co and sandbox.partners.fanati.co.

## 📅 Current Status

- **Certificate Valid Until**: February 15, 2026
- **Provider**: Let's Encrypt (free)
- **Method**: Webroot authentication
- **Auto-renewal**: Enabled via cron

## 🔐 Certificate Details

### Domains Covered
- sandbox.partners.fanati.co (active) ✅
- partners.fanati.co (pending configuration)

### Certificate Locations
```
/etc/letsencrypt/live/sandbox.partners.fanati.co/
├── cert.pem       # Server certificate
├── chain.pem      # Intermediate certificates
├── fullchain.pem  # cert.pem + chain.pem
└── privkey.pem    # Private key
```

## 🚀 Initial Setup

### 1. Install Certbot

```bash
sudo apt update
sudo apt install certbot python3-certbot-nginx
```

### 2. Create Webroot Directory

```bash
sudo mkdir -p /home/sebastian/certbot/www
sudo chown sebastian:sebastian /home/sebastian/certbot/www
```

### 3. Configure Nginx for Webroot

Add to your nginx configuration:

```nginx
# Certbot webroot location
location /.well-known/acme-challenge/ {
    root /var/www/certbot;
}
```

### 4. Obtain Certificate

```bash
sudo certbot certonly --webroot \
    -w /home/sebastian/certbot/www \
    -d sandbox.partners.fanati.co \
    --email sebastian@fanati.co \
    --agree-tos \
    --non-interactive
```

## 📝 Nginx HTTPS Configuration

### Main Server Nginx (/home/sebastian/nginx/sites-enabled/)

```nginx
server {
    listen 443 ssl http2;
    server_name sandbox.partners.fanati.co;

    # SSL Configuration
    ssl_certificate /home/sebastian/certbot/live/sandbox.partners.fanati.co/fullchain.pem;
    ssl_certificate_key /home/sebastian/certbot/live/sandbox.partners.fanati.co/privkey.pem;

    # SSL Security Settings
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;
    ssl_prefer_server_ciphers on;
    ssl_session_cache shared:SSL:10m;
    ssl_session_timeout 10m;

    # Security Headers
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;

    # Proxy to Docker nginx
    location / {
        proxy_pass http://127.0.0.1:8088;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto https;
    }

    # Certbot webroot
    location /.well-known/acme-challenge/ {
        root /var/www/certbot;
    }
}

# HTTP to HTTPS redirect
server {
    listen 80;
    server_name sandbox.partners.fanati.co;

    location /.well-known/acme-challenge/ {
        root /var/www/certbot;
    }

    location / {
        return 301 https://$server_name$request_uri;
    }
}
```

### Docker Nginx Container Configuration

The Docker nginx container (`partners-nginx`) handles routing between applications but doesn't handle SSL directly - that's done by the main server nginx.

## 🔄 Certificate Renewal

### Automatic Renewal (Cron)

Add to crontab (`sudo crontab -e`):

```cron
# Renew certificates twice daily
0 0,12 * * * certbot renew --quiet --webroot -w /home/sebastian/certbot/www && docker exec nginx_proxy nginx -s reload
```

### Manual Renewal

```bash
# Test renewal (dry run)
sudo certbot renew --dry-run --webroot -w /home/sebastian/certbot/www

# Actual renewal
sudo certbot renew --webroot -w /home/sebastian/certbot/www

# Reload nginx after renewal
sudo docker exec nginx_proxy nginx -s reload
```

### Check Certificate Status

```bash
# List all certificates
sudo certbot certificates

# Check expiry date
echo | openssl s_client -servername sandbox.partners.fanati.co -connect sandbox.partners.fanati.co:443 2>/dev/null | openssl x509 -noout -dates
```

## 🔍 Troubleshooting

### Common Issues

1. **Webroot path error**
   - Ensure `/var/www/certbot` exists in container
   - Map volume correctly: `/home/sebastian/certbot/www:/var/www/certbot`

2. **Certificate not found**
   - Check symlinks in `/etc/letsencrypt/live/`
   - Verify certificate paths in nginx config

3. **Renewal fails**
   - Check webroot accessibility: `curl http://domain/.well-known/acme-challenge/test`
   - Ensure port 80 is accessible for challenge
   - Check certbot logs: `/var/log/letsencrypt/letsencrypt.log`

### Verify HTTPS

```bash
# Check SSL certificate
curl -vI https://sandbox.partners.fanati.co

# Test SSL configuration
openssl s_client -connect sandbox.partners.fanati.co:443 -servername sandbox.partners.fanati.co

# Check SSL grade (external)
# Visit: https://www.ssllabs.com/ssltest/analyze.html?d=sandbox.partners.fanati.co
```

## 🎯 Production Setup (partners.fanati.co)

When ready to setup production:

```bash
# Obtain certificate for production domain
sudo certbot certonly --webroot \
    -w /home/sebastian/certbot/www \
    -d partners.fanati.co \
    -d www.partners.fanati.co \
    --email sebastian@fanati.co \
    --agree-tos \
    --non-interactive

# Update nginx configuration
sudo nano /home/sebastian/nginx/sites-enabled/partners.fanati.co.conf

# Test and reload
sudo nginx -t
sudo systemctl reload nginx
```

## 📊 Monitoring

### Certificate Expiry Monitoring

Create a monitoring script:

```bash
#!/bin/bash
# /home/sebastian/scripts/check-ssl-expiry.sh

DOMAINS="sandbox.partners.fanati.co partners.fanati.co"

for domain in $DOMAINS; do
    echo "Checking $domain..."
    echo | openssl s_client -servername $domain -connect $domain:443 2>/dev/null | \
    openssl x509 -noout -dates | grep notAfter
done
```

### Set up alerts

```cron
# Weekly SSL expiry check
0 9 * * 1 /home/sebastian/scripts/check-ssl-expiry.sh | mail -s "SSL Certificate Status" sebastian@fanati.co
```

## 🔒 Security Best Practices

1. **Strong SSL Configuration**
   - Use TLS 1.2 and 1.3 only
   - Disable weak ciphers
   - Enable HSTS header

2. **Regular Updates**
   ```bash
   sudo apt update
   sudo apt upgrade certbot python3-certbot-nginx
   ```

3. **Backup Certificates**
   ```bash
   sudo tar -czf /backup/letsencrypt-$(date +%Y%m%d).tar.gz /etc/letsencrypt
   ```

4. **Monitor Logs**
   ```bash
   tail -f /var/log/letsencrypt/letsencrypt.log
   tail -f /var/log/nginx/error.log
   ```

## 📚 Resources

- [Let's Encrypt Documentation](https://letsencrypt.org/docs/)
- [Certbot Documentation](https://certbot.eff.org/docs/)
- [SSL Labs Test](https://www.ssllabs.com/ssltest/)
- [Mozilla SSL Configuration Generator](https://ssl-config.mozilla.org/)

## 🆘 Support

For SSL/certificate issues:
1. Check certbot logs: `sudo cat /var/log/letsencrypt/letsencrypt.log`
2. Verify nginx configuration: `sudo nginx -t`
3. Test certificate: `openssl x509 -in /path/to/cert.pem -text -noout`
4. Contact: sebastian@fanati.co