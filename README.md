# Partners Fanati.co - MLM Platform Monorepo

This monorepo contains two MLM platforms for the Fanatico partner network:

## 🏗️ Repository Structure

```
partners-fanati-co/
├── infinite-mlm/          # Infinite MLM Software (Primary - partners.fanati.co)
│   ├── Dockerfile
│   ├── docker-compose.yml
│   └── src/               # Application source code
├── hybrid-mlm/            # Legacy HybridMLM (partners.fanati.co/legacy)
│   ├── Dockerfile
│   ├── docker-compose.yml
│   └── public_html/       # Legacy application
├── docker-compose.yml     # Orchestrates both applications
├── nginx/                 # Reverse proxy configuration
└── .github/               # CI/CD workflows
```

## 🚀 Applications

### 1. Infinite MLM Software (Primary)
- **URL**: https://partners.fanati.co
- **Port**: 8085 (internal)
- **Stack**: PHP 8.1, Laravel/Custom, MySQL
- **Features**:
  - Binary MLM with spillover
  - Board Plan integration
  - FCO Token management
  - E-wallet with 60/40 commission splitting
  - Mining pool simulation

### 2. HybridMLM (Legacy)
- **URL**: https://partners.fanati.co/legacy (or port 8086)
- **Port**: 8086 (internal)
- **Stack**: PHP 7.4/8.1, Custom PHP
- **Status**: Maintained for backward compatibility
- **Features**:
  - Existing FCO token module
  - Legacy member database
  - Historical commission data

## 🐳 Docker Setup

### Quick Start

```bash
# Clone the repository
git clone https://github.com/fanaticodev/partners-fanati-co.git
cd partners-fanati-co

# Start both applications
docker-compose up -d

# View logs
docker-compose logs -f

# Access applications
# Infinite MLM: http://localhost:8085
# HybridMLM: http://localhost:8086
```

### Individual Application Management

```bash
# Infinite MLM only
docker-compose up -d infinite-mlm infinite-mlm-db

# HybridMLM only
docker-compose up -d hybrid-mlm hybrid-mlm-db

# Restart specific service
docker-compose restart infinite-mlm
```

## 🔧 Development

### Environment Setup

1. Copy environment files:
```bash
cp infinite-mlm/.env.example infinite-mlm/.env
cp hybrid-mlm/.env.example hybrid-mlm/.env
```

2. Configure database credentials in each `.env` file

3. Install dependencies:
```bash
# Infinite MLM
cd infinite-mlm
composer install
php artisan key:generate
php artisan migrate

# HybridMLM
cd ../hybrid-mlm
# Legacy setup commands
```

### Database Management

```bash
# Infinite MLM database backup
docker exec infinite-mlm-db mysqldump -u root -p infinite_mlm > infinite_backup.sql

# HybridMLM database backup
docker exec hybrid-mlm-db mysqldump -u root -p hybrid_mlm > hybrid_backup.sql
```

## 🌐 Production Deployment

### Nginx Configuration

The repository includes an Nginx configuration that:
- Routes main domain to Infinite MLM
- Routes `/legacy` path to HybridMLM
- Handles SSL termination
- Manages load balancing

### Deployment Process

1. Push to `main` branch triggers GitHub Actions
2. Workflow pulls latest code on production server
3. Docker containers are rebuilt and restarted
4. Health checks verify deployment

### URLs

- **Production (Infinite)**: https://partners.fanati.co
- **Production (Legacy)**: https://partners.fanati.co/legacy
- **Staging**: https://staging-partners.fanati.co

## 🔄 Migration Strategy

### Phase 1: Parallel Operation (Current)
- Both systems run independently
- Shared user authentication via SSO
- Data sync via scheduled jobs

### Phase 2: Data Migration
- Migrate user accounts
- Transfer commission history
- Import genealogy trees
- Sync wallet balances

### Phase 3: Feature Parity
- Implement missing features in Infinite MLM
- Validate business logic
- User acceptance testing

### Phase 4: Sunset Legacy
- Redirect all traffic to Infinite MLM
- Archive HybridMLM database
- Maintain read-only access for historical data

## 📊 Monitoring

### Health Checks

- Infinite MLM: https://partners.fanati.co/health
- HybridMLM: https://partners.fanati.co/legacy/health

### Logs

```bash
# Application logs
docker-compose logs infinite-mlm
docker-compose logs hybrid-mlm

# Database logs
docker-compose logs infinite-mlm-db
docker-compose logs hybrid-mlm-db
```

## 🔐 Security

- Database ports bound to localhost only
- SSL/TLS via Nginx reverse proxy
- Environment variables for sensitive data
- Regular security updates via Renovate
- Database backups to B2 storage

## 📦 CI/CD Pipeline

GitHub Actions workflow:
1. Linting and code quality checks
2. Security vulnerability scanning
3. Build Docker images
4. Run tests
5. Deploy to production
6. Post-deployment health checks

## 🛠️ Maintenance Commands

```bash
# Clear caches
docker exec infinite-mlm php artisan cache:clear

# Run migrations
docker exec infinite-mlm php artisan migrate

# Update dependencies
docker exec infinite-mlm composer update

# View running containers
docker-compose ps

# System resource usage
docker stats
```

## 📝 Documentation

- [Infinite MLM Setup Guide](./infinite-mlm/README.md)
- [HybridMLM Documentation](./hybrid-mlm/README.md)
- [API Documentation](./docs/api.md)
- [Migration Guide](./docs/migration.md)
- [MLM Requirements](./docs/mlm-requirements.md)

## 🤝 Contributing

1. Create feature branch from `main`
2. Make changes in appropriate application directory
3. Test locally with Docker
4. Submit pull request
5. Await code review and CI checks

## 📄 License

Proprietary - All rights reserved

## 🆘 Support

For issues or questions:
- Create GitHub issue
- Email: support@fanati.co
- Slack: #partners-portal

---

**Repository**: https://github.com/fanaticodev/partners-fanati-co
**Production**: https://partners.fanati.co
**Last Updated**: November 2024