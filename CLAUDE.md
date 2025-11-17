# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

**Last Updated**: November 17, 2025
**SSL Status**: ✅ Valid until February 15, 2026
**Sandbox**: https://sandbox.partners.fanati.co
**Repository**: https://github.com/fanaticodev/partners-fanati-co

## Project Overview

This repository contains a monorepo deployment for partners.fanati.co with two distinct MLM applications:

1. **Infinite MLM Software** - Modern MLM platform (Primary) at partners.fanati.co
   - PHP 8.1 with nginx/PHP-FPM
   - Currently showing placeholder, awaiting software installation
   - Port 8085 (internal), Database port 3308

2. **HybridMLM application** - Legacy MLM system at partners.fanati.co/legacy
   - PHP 7.4 with Apache
   - Contains FCO Token module
   - Port 8086 (internal), Database port 3309

Both applications are fully containerized with Docker and accessible via HTTPS with valid SSL certificates.

## Key Commands

### Docker Operations
```bash
# Build and start containers
docker-compose up -d

# View container logs
docker-compose logs -f infinite-mlm
docker-compose logs -f hybrid-mlm

# Restart containers
docker-compose restart infinite-mlm hybrid-mlm

# Check health status
curl http://localhost:8085/health.php
curl http://localhost:8086/health.php

# Database backups
docker exec infinite-mlm-db mysqldump -u infinite_user infinite_mlm > infinite_backup.sql
docker exec hybrid-mlm-db mysqldump -u hybrid_user hybrid_mlm > hybrid_backup.sql
```

### Sandbox Management
```bash
# Use the sandbox script for development
./sandbox.sh up        # Start sandbox
./sandbox.sh status    # Check status
./sandbox.sh logs      # View logs
./sandbox.sh down      # Stop sandbox
./sandbox.sh db infinite  # Access Infinite MLM database
./sandbox.sh db hybrid    # Access Hybrid MLM database
```

### GitHub Actions Deployment
Deployments are triggered automatically on push to `main` branch. The workflow:
1. Pulls code to `/home/sebastian/git-repos/partners-fanati-co`
2. Syncs to production at `/home/sebastian/sites/partners.fanati.co/`
3. Rebuilds Docker containers
4. Performs health checks

## Architecture & Structure

### HybridMLM System Architecture
The production system is a custom PHP MLM platform with:

- **Core Application**: `/hybridmlm/public_html/fanatics/app/`
  - Custom module system under `app/Components/Modules/`
  - Currently has `FcoTokens` module for token management
  - Uses vendor dependencies including cron-expression for scheduling

- **Public Assets**: `/hybridmlm/public_html/fanatics/public/`
  - Contains vendor libraries (jQuery, file upload, cropper.js, etc.)
  - Laravel filemanager integration
  - Global plugins directory

- **Storage**: `/hybridmlm/public_html/fanatics/storage/`
  - Framework views (Blade compiled templates)
  - Logs and cache directories
  - User uploads

### Module System
The application uses a modular architecture where functionality is organized into modules:
- Located in `app/Components/Modules/General/`
- Each module has its own `ModuleCore` with vendor dependencies
- Currently implements FcoTokens for cryptocurrency token management

### Database Structure
- MariaDB 10.11 running on port 3307 (localhost only)
- Database name: `partners`
- Managed through Docker container `partners_db`

## MLM Research Context

The repository contains extensive MLM platform research documents:
- `onecoin-mlm-acceptance-criteria.md` - Detailed requirements (306 criteria)
- `onecoin-mlm-technical-summary.md` - Technical implementation guide
- Various vendor research PDFs (GPT, Gemini, GROK, Infinite MLM)

These documents inform the implementation of:
- Binary tree structures with spillover
- Multiple bonus types (direct, network, matching, start-up)
- Token management with doubling/splitting mechanisms
- Board Plan integration with Binary Plan
- E-wallet with 60/40 commission splitting

## Important Notes

1. **Monorepo Structure**: The repository contains two separate MLM applications (Infinite MLM and HybridMLM) orchestrated via Docker Compose.

2. **Infinite MLM Status**: Currently showing a placeholder page. The actual Infinite MLM software needs to be installed in the `infinite-mlm/src/` directory.

3. **HybridMLM**: Legacy system that is NOT standard Laravel. It's a custom PHP application with its own module architecture.

4. **Module Development**: For HybridMLM, new functionality should be added as modules under `app/Components/Modules/General/` following the FcoTokens pattern.

5. **Token Integration**: The FcoTokens module in HybridMLM is critical for the MLM token economy. Any modifications should consider the token doubling, board splitting, and commission calculation requirements detailed in the acceptance criteria.

6. **SSL/HTTPS**: Both applications are accessible via HTTPS with valid SSL certificates (auto-renewing via Let's Encrypt).

## Network Configuration

### Port Mappings
- **Infinite MLM**: Port 8085 (localhost only)
- **Hybrid MLM**: Port 8086 (localhost only)
- **Nginx Router**: Port 8088 (localhost only)
- **Infinite DB**: Port 3308 (localhost only)
- **Hybrid DB**: Port 3309 (localhost only)
- **Redis**: Port 6379 (internal only)

### Docker Networks
- **partners-network**: Internal communication between services
- **web-network**: External network for main server nginx proxy

### Access Points
- **Production**: https://partners.fanati.co (via main nginx → port 8088)
- **Sandbox**: https://sandbox.partners.fanati.co (currently active)
- **Local**: http://localhost:8088 (nginx router)

## Security Considerations

- ✅ SSL certificates valid until February 15, 2026
- ✅ Automatic HTTPS redirect configured
- ✅ Database ports bound to localhost only
- ✅ Environment variables for credentials
- ✅ Docker network isolation between services
- ✅ Security headers (X-Frame-Options, X-XSS-Protection, etc.)
- ✅ Sensitive files excluded from Git (`.env`, `vendor/`, logs)

## Current Status (November 17, 2025)

### Working
- ✅ Docker infrastructure fully operational
- ✅ SSL/HTTPS for sandbox.partners.fanati.co
- ✅ Health check endpoints for both applications
- ✅ Placeholder pages with system information
- ✅ GitHub Actions CI/CD pipeline

### Pending
- ⏳ Install actual Infinite MLM software
- ⏳ Configure production domain (partners.fanati.co)
- ⏳ Import existing member data
- ⏳ Set up payment processing
- ⏳ Configure email notifications