#!/bin/bash

echo "Starting Clinical Management System..."

# Start Docker containers using docker compose (v2)
echo "Starting MySQL and phpMyAdmin with Docker..."
docker compose up -d

# Wait for MySQL to be ready
echo "Waiting for MySQL to be ready..."
for i in {1..30}; do
    if docker exec clinical-mysql mysqladmin ping -h localhost --silent 2>/dev/null; then
        echo "MySQL is ready!"
        break
    fi
    echo "Waiting... ($i/30)"
    sleep 2
done

# Start Laravel server in background
echo "Starting Laravel server..."
php artisan serve --port=8000 > /tmp/laravel.log 2>&1 &
LARAVEL_PID=$!

# Start Vite dev server in background
echo "Starting Vite dev server..."
npm run dev > /tmp/vite.log 2>&1 &
VITE_PID=$!

echo ""
echo "========================================="
echo "Services started successfully!"
echo "========================================="
echo "Laravel:    http://localhost:8000"
echo "Vite:       http://localhost:5173"
echo "phpMyAdmin: http://localhost:8080"
echo "  - Credentials: see MYSQL_* variables in .env (defaults in .env.example)"
echo "========================================="
echo ""
echo "Logs:"
echo "  Laravel: /tmp/laravel.log"
echo "  Vite:    /tmp/vite.log"
echo "  Docker:  docker compose logs -f"
echo ""
echo "To stop all services: docker compose down"
echo "PIDs - Laravel: $LARAVEL_PID, Vite: $VITE_PID"
