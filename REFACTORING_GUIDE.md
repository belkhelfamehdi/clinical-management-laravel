# Clinical Management - Laravel + Vue Refactoring Guide

## What Was Refactored

### Old Project Issues:
- Procedural PHP with SQL injection vulnerabilities
- MD5 password hashing (insecure)
- Duplicated code (navigation in every file)
- No MVC structure
- Mixed HTML/PHP (no separation of concerns)

### New Architecture:
- **Laravel 10**: Modern PHP framework with MVC pattern
- **Vue 3**: Reactive frontend framework
- **Inertia.js**: Bridge between Laravel and Vue (no API needed)
- **Tailwind CSS**: Utility-first CSS framework
- **SQLite**: For development (easy setup)

## Project Structure
```
clinical-management/
├── app/
│   ├── Models/          # Eloquent models (Patient, Employee, etc.)
│   ├── Http/Controllers/ # Controllers (PatientController, etc.)
│   └── Middleware/
├── resources/
│   ├── js/
│   │   ├── Pages/      # Vue components (Dashboard, Patients/*, etc.)
│   │   └── app.js     # Vue entry point
│   └── views/
│       └── app.blade.php # Main layout
├── routes/
│   └── web.php        # Laravel routes
└── database/
    └── migrations/     # Database schema
```

## How to Run the Project

### Option 1: Using XAMPP (Apache + MySQL)
1. Start Apache and MySQL in XAMPP
2. Update `.env` file to use MySQL:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pfc
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. Run: `php artisan migrate` (if you want to use new tables)
4. Or keep using old `pfc` database (data is preserved in `clinical-management-old`)

### Option 2: Using Laravel's Built-in Server (Easier)
1. Terminal 1: `php artisan serve` (starts at http://localhost:8000)
2. Terminal 2: `npm run dev` (starts Vite for Vue hot-reload)
3. Visit http://localhost:8000

## Key Improvements
1. **Security**: Uses Laravel's Eloquent ORM (prevents SQL injection)
2. **Password Hashing**: Uses bcrypt instead of MD5
3. **CSRF Protection**: Built-in Laravel protection
4. **Validation**: Server-side validation with proper error messages
5. **Reusable Components**: Vue components with Inertia.js
6. **Modern UI**: Tailwind CSS for responsive design

## Files Created
- Models match your old database structure (`patient`, `employe`, etc.)
- Controllers handle CRUD operations
- Vue pages for Dashboard, Patients, Employees
- Migrations for new tables (optional - you can keep using old DB)

## Next Steps
1. Start the servers (see "How to Run" above)
2. Visit the app and test Patient/Employee management
3. Add more features: Pharmacy, Rooms, Blood Bank, Invoices
4. Add authentication with Laravel Breeze (optional)

## Troubleshooting
- If MySQL doesn't connect, use SQLite (already configured in .env)
- Run `npm install` if node_modules is missing
- Run `composer install` if vendor folder is missing
