## FINANCE MANAGEMENT

```bash
docker compose up -d --build
docker compose exec -it finance-app composer install
docker compose exec -it finance-app composer dump-autoload
docker compose exec -it finance-app php artisan key:generate
```