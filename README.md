# Clinical Management

A small clinic management app for handling patients, staff, pharmacy stock, rooms,
the blood bank, invoices and leave requests. Backend is Laravel, frontend is Vue 3
wired through Inertia.

## Stack

- Laravel (PHP 8.3)
- Vue 3 + Inertia
- Tailwind CSS
- MySQL

## Running it

MySQL and phpMyAdmin run in Docker:

```bash
docker compose up -d
```

Then start the app and the Vite dev server (or just run `./start.sh`):

```bash
php artisan serve --port=8000
npm run dev
```

- App: http://localhost:8000
- phpMyAdmin: http://localhost:8080

The database name and credentials are defined in `docker-compose.yml` (db `pfc`).

## Without Docker

Point `.env` at a local MySQL instance and run the migrations:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=pfc
DB_USERNAME=root
DB_PASSWORD=
```

```bash
php artisan migrate
php artisan serve --port=8000
npm run dev
```

If config or route changes don't show up, clear the caches:

```bash
php artisan config:clear && php artisan route:clear
```
