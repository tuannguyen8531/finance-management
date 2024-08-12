## FINANCE MANAGEMENT

```bash
docker compose up -d --build
docker exec finance-app composer install
docker exec finance-app composer dump-autoload
docker exec finance-app php artisan key:generate
```