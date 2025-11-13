# Partners Fanati.co

Partner portal for the Fanatico network - Laravel application (HybridMLM)

## Overview

This repository contains the partner portal application for partners.fanati.co, a Laravel-based multi-level marketing (MLM) system.

## Technology Stack

- **Framework**: Laravel 9.x
- **PHP Version**: 8.1+
- **Database**: MySQL/MariaDB
- **Frontend**: Blade templates, Bootstrap
- **Application**: HybridMLM system

## Repository Structure

```
partners-fanati-co/
├── app/                # Laravel application code
├── bootstrap/          # Bootstrap files
├── config/            # Configuration files
├── database/          # Migrations and seeds
├── public/            # Public assets
├── resources/         # Views and raw assets
├── routes/            # Application routes
├── storage/           # Logs, cache, uploads
├── tests/             # Test files
├── .env.example       # Environment variables template
├── composer.json      # PHP dependencies
├── Dockerfile         # Docker container definition
└── docker-compose.yml # Docker services configuration
```

## Local Development

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL/MariaDB
- Node.js and npm (for asset compilation)

### Setup

1. Clone the repository:
```bash
git clone https://github.com/fanaticodev/partners-fanati-co.git
cd partners-fanati-co
```

2. Install PHP dependencies:
```bash
composer install
```

3. Copy environment file:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Configure database in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=partners
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Run migrations:
```bash
php artisan migrate
```

7. Start development server:
```bash
php artisan serve
```

The application will be available at http://localhost:8000

## Production Deployment

The application is deployed to the Fremont2 server at `/home/sebastian/sites/partners.fanati.co/`

### Deployment Process

1. Push changes to the `main` branch
2. GitHub Actions automatically deploys to production
3. Application runs in Docker container behind NGINX reverse proxy

### Production URL

https://partners.fanati.co

## Docker Configuration

### Building the Image

```bash
docker build -t partners-fanati-co:latest .
```

### Running with Docker Compose

```bash
docker-compose up -d
```

## Database Management

### Backup
```bash
docker exec partners_db mysqldump -u root -p partners > backup.sql
```

### Restore
```bash
docker exec -i partners_db mysql -u root -p partners < backup.sql
```

## Security

- All credentials are stored in environment variables
- Database access is restricted to localhost
- Application runs behind NGINX with SSL termination
- Regular security updates via Renovate bot

## CI/CD

GitHub Actions workflow handles:
- Code linting and testing
- Security scanning
- Automated deployment to production
- Health checks post-deployment

## Maintenance

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Update Dependencies
```bash
composer update
npm update
```

## Support

For issues or questions, please create an issue in this repository.

## License

Proprietary - All rights reserved

---

**Migration Date**: November 12, 2025
**Previous Location**: Part of fanatico-sites monorepo (now separated for better maintainability)