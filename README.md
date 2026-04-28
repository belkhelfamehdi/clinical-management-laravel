# Clinical Management System

A modernized clinical management system built with **Laravel 13 + Vue 3 + Inertia.js** with Docker support.

## Features

- **Patient Management**: Add, edit, delete patients
- **Employee Management**: Manage doctors, nurses, and staff
- **Pharmacy**: Manage medications and stock
- **Room Management**: Track room assignments
- **Blood Bank**: Manage blood donations and stock
- **Invoicing**: Generate and track invoices
- **Leave Management**: Track employee leaves

## Tech Stack

- **Backend**: Laravel 13.6 (PHP 8.2+)
- **Frontend**: Vue 3 with Inertia.js
- **Styling**: Tailwind CSS
- **Database**: MySQL 8.0 (via Docker)
- **Admin Panel**: phpMyAdmin (via Docker)

## Quick Start with Docker (Recommended)

1. **Start all services**:
   ```bash
   cd /home/mehdibelkhelfa/Dev/Projects/clinical-management
   docker-compose up -d
   ```

2. **Start Laravel & Vite** (in separate terminals or use `./start.sh`):
   ```bash
   # Terminal 1
   php artisan serve --port=8000

   # Terminal 2
   npm run dev
   ```

3. **Access the app**:
   - Laravel App: http://localhost:8000
   - Vite Dev Server: http://localhost:5173
   - phpMyAdmin: http://localhost:8080
     - Username: `clinical_user`
     - Password: `clinical_pass`
     - Root Password: `rootpassword`

## Manual Setup (Without Docker)

1. **Start MySQL** (using XAMPP or manual install)

2. **Configure `.env`**:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pfc
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. **Run migrations** (optional - uses existing `pfc` database):
   ```bash
   php artisan migrate
   ```

4. **Start servers**:
   ```bash
   php artisan serve --port=8000
   npm run dev
   ```

## Project Structure

```
clinical-management/
├── app/
│   ├── Models/          # Eloquent models (Patient, Employee, etc.)
│   ├── Http/Controllers/ # Controllers
│   └── Middleware/
├── resources/
│   ├── js/
│   │   ├── Pages/      # Vue components
│   │   └── app.js     # Vue entry point
│   └── views/
├── routes/
│   └── web.php        # Laravel routes
├── database/
│   ├── migrations/
│   └── mysql/         # Docker init scripts
├── docker-compose.yml  # Docker configuration
└── start.sh           # Quick start script
```

## Migration from Old System

The old procedural PHP system is preserved in `clinical-management-old/`. The new system:
- Uses the same database structure (`patient`, `employe`, etc.)
- Keeps all existing data intact
- Adds modern security (CSRF, SQL injection protection)
- Provides a reactive Vue.js frontend

## Development

- **Laravel Framework**: 13.6.0
- **Vue.js**: 3.5.33
- **Inertia.js**: 3.0.3
- **Tailwind CSS**: 4.2.4

## Troubleshooting

- **MySQL connection issues**: Check Docker containers with `docker ps`
- **Vite errors**: Run `npm install` to ensure all packages are installed
- **Laravel errors**: Run `php artisan config:clear && php artisan route:clear`

## License

MIT
