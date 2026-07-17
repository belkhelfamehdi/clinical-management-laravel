# Clinical Management

A clinic back-office for managing patients, staff, pharmacy stock, hospital rooms,
a blood bank, invoices, salaries, leave requests and appointments — built with
Laravel 13 on the backend and Vue 3 (via Inertia.js) on the frontend.

## Context

This project is the modernization of an older clinic system written in
**procedural PHP** (the legacy `pfc` database). The goal was to keep the existing
data and schema while rebuilding the application on a modern stack:

- The **legacy MySQL schema is preserved as-is** — original table and column names
  (`patient`, `employe`, `cong`, `donneur`, `stocks`, `ordonnance`, …) are mapped
  through Eloquent models rather than renamed, so an existing database can be
  plugged in directly. The old structure is reproduced in
  `docker/mysql/init/01-create-tables.sql` and mirrored by a Laravel migration.
- The stack moved to **Laravel 13 + Vue 3 + Inertia.js**, replacing hand-written
  PHP pages and inline SQL.
- **Security was added on top of the legacy app**: CSRF protection on every form
  (Laravel default), prepared statements everywhere through Eloquent (no more
  string-concatenated SQL), request validation on all writes, and password
  hashing with bcrypt (the legacy `admin` table used raw MD5).

## Screenshots

> Screenshots live in `docs/screenshots/` (see the folder for the expected files).

| Dashboard | Patients | Blood bank |
|-----------|----------|------------|
| ![Dashboard](docs/screenshots/dashboard.png) | ![Patients](docs/screenshots/patients.png) | ![Blood bank](docs/screenshots/bloodbank.png) |

## Features

Implemented and wired end-to-end (controller + Eloquent model + Vue/Inertia page):

- **Authentication** — login, register, logout with bcrypt hashing and session
  regeneration; every application route is behind the `auth` middleware.
- **Dashboard** — aggregated counts (patients, staff, rooms, medication, donors),
  total invoiced revenue, current blood stock, and latest patients/staff.
- **Patients** — full CRUD.
- **Staff / employees** — full CRUD.
- **Pharmacy** — medication stock, full CRUD.
- **Salaries** — full CRUD, linked to employees.
- **Rooms** — assign a patient and a staff member to a room (create / list / delete).
- **Invoices** — create / list / delete, with a running revenue total.
- **Blood bank** — donor registration with automatic blood-stock increment
  (create / list / delete).
- **Leave requests** — create / list / delete.
- **Appointments** — create / list / delete.

Known gaps (kept honest on purpose): the leave-request *edit* screen and the
appointment ↔ doctor link are not fully wired yet, and there is no automated test
suite beyond the default scaffolding.

## Tech stack

Versions as declared in `composer.json` / `package.json`:

- **PHP** ^8.3
- **Laravel** ^13.0
- **Inertia** (`inertiajs/inertia-laravel` ^3.0, `@inertiajs/vue3` ^3.0)
- **Vue** ^3.5
- **Vite** ^8.0 with `laravel-vite-plugin` ^3.0
- **Tailwind CSS** ^4.2
- **MySQL** 8.0 (via Docker; SQLite is used as the zero-config default in `.env.example`)

## Architecture

The frontend and backend are a **single Laravel application**, not a separate SPA
talking to a REST API. Inertia.js was chosen so that controllers return Vue pages
directly (`Inertia::render('Patients/Index', …)`) while keeping server-side routing,
validation and CSRF — this avoids building and versioning a standalone API layer
and duplicating validation on the client, which is overkill for an internal
back-office of this size.

Migration state, **Blade → Vue**: the entire user-facing UI is Vue 3 / Inertia
(~2,000 lines across 28 components under `resources/js/Pages`). Blade is reduced to
the Inertia root template (`app.blade.php`) and error pages; the default
`welcome.blade.php` is unused. In other words, the view layer is effectively fully
migrated — legacy procedural PHP pages are gone, replaced by Vue components.

## Getting started (Docker)

MySQL and phpMyAdmin run in Docker; credentials come from `MYSQL_*` variables
(defaults in `.env.example`, override them in your own `.env`).

```bash
cp .env.example .env
composer install
php artisan key:generate

docker compose up -d      # MySQL + phpMyAdmin
php artisan migrate       # or import docker/mysql/init/01-create-tables.sql

npm install
php artisan serve --port=8000    # app  -> http://localhost:8000
npm run dev                      # Vite dev server
```

`./start.sh` wraps the Docker + server steps. phpMyAdmin is exposed on
`http://localhost:8080`.

## License

MIT.
