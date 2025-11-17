# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This repository contains a hybrid deployment setup for partners.fanati.co with two distinct components:

1. **Docker-based Laravel stub** - A minimal Laravel setup in the root directory (for future migration)
2. **HybridMLM application** - The actual production MLM system in `/hybridmlm/public_html/fanatics/`

The HybridMLM system is a legacy PHP application (not standard Laravel) implementing an MLM platform with custom modules, particularly focusing on FCO token management.

## Key Commands

### Docker Operations
```bash
# Build and start containers
docker-compose up -d

# View container logs
docker-compose logs -f partners_app

# Restart containers
docker-compose restart

# Database backup
docker exec partners_db mysqldump -u root -p partners > backup.sql
```

### HybridMLM Deployment (Production)
The actual production application runs from `/home/sebastian/sites/partners.fanati.co/hybridmlm/public_html/fanatics/` and is NOT managed by Docker. This is a legacy deployment accessed directly via filesystem.

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

1. **Dual Structure**: The repository has both a Docker Laravel stub AND the actual HybridMLM production system. The HybridMLM system is what's currently serving partners.fanati.co.

2. **Not Standard Laravel**: The HybridMLM application does not have an `artisan` file and doesn't follow standard Laravel structure. It's a custom PHP application with its own architecture.

3. **Module Development**: New functionality should be added as modules under `app/Components/Modules/General/` following the FcoTokens pattern.

4. **Token Integration**: The FcoTokens module is critical for the MLM token economy. Any modifications should consider the token doubling, board splitting, and commission calculation requirements detailed in the acceptance criteria.

5. **Production Access**: The live application is served from the `hybridmlm` directory, not the Docker containers. Docker setup is for future migration.

## Network Configuration

- Application runs on port 8084 (internal)
- Accessed via NGINX reverse proxy at partners.fanati.co
- Database on port 3307 (localhost only)
- Part of Docker networks: partners-network, web-network

## Security Considerations

- Database credentials in environment variables
- Database bound to localhost only
- SSL termination at NGINX level
- Sensitive files excluded from Git (`.env`, `vendor/`, logs)