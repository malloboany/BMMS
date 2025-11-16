# BMMS
Booking Management Mini System

## How to login dashboard

- Go to `http://localhost/admin/login`
- Use:
  - Email: `admin@example.com`
  - Password: `password`

## Installation

1. Clone the repository:
   - `git clone <repo-url>`
   - `cd BMMS`
2. Install PHP dependencies:
   - `composer install`
3. Create and configure environment:
   - Copy `.env.example` to `.env`
   - Update database credentials (`DB_*`) to point to your MySQL instance
   - Run `php artisan key:generate`
4. Run database migrations and seeders:
   - `php artisan migrate --force`
   - `php artisan db:seed --force`
5. Build frontend assets (for landing page and shared Tailwind styles):
   - `npm install`
   - `npm run build`
6. Start the application:
   - `php artisan serve --port=8001`
   - Dashboard: `http://localhost:8001/admin`

## System structure

- `app/Models`
  - Core models: `User`, `Role`, `Permission` (via Spatie), `ServiceType`, `Booking`.
- `app/Filament/Admin`
  - `Resources`: CRUD for Users, Roles, Permissions, Service Types, Bookings.
  - `Pages/Dashboard`: Custom Filament dashboard page (account widget + bookings analytics).
  - `Widgets/BookingsAnalytics`: Dashboard analytics widget (stats, calendar, today’s bookings).
- `routes/web.php`
  - Landing page at `/`.
- `routes/api.php`
  - Public JSON API for services and bookings.
- `app/Http/Controllers/Api`
  - `ServiceController@index`: `GET /api/services`.
  - `BookingController@store`: `POST /api/bookings`.
- `app/Models/MyResult`
  - Standard API response envelope: `success`, `code`, `message`, `data`.

## Tools and technologies

- PHP 8.2+
- Laravel 12 (application framework)
- Filament 4 (admin panel and UI)
- Livewire (reactive Filament pages/widgets)
- Spatie Laravel-Permission (roles & permissions)
- MySQL (primary database)
- Tailwind CSS 4 (utility-first styling, via Vite build)
- Vite (asset bundler for `resources/css/app.css` and `resources/js/app.js`)

## API collection (Postman)

- A Postman collection is included in the project root:
  - `BMMS.postman_collection.json`
- It documents:
  - `GET /api/services` – list all service types (`id`, `name`).
  - `POST /api/bookings` – create a booking with:
    - `customer_name`, `phone`, `booking_date`, `service_type_id`, `notes?`.
  - Responses are wrapped in the `MyResult` model:
    - `success: bool`
    - `code: int` (HTTP status)
    - `message: string`
    - `data: mixed` (payload or validation errors)
- The collection includes example requests and responses so you can quickly test the API.

## Dashboard analytics (bookings)

- Accessible to users with the `manage bookings` permission inside the Filament admin panel.
- The bookings analytics widget on the dashboard shows:
  - **Today’s pending bookings** count (bookings with `status = pending` and `booking_date` = today).
  - **Monthly status counts** for the selected month:
    - Pending / Confirmed / Cancelled.
  - **Interactive calendar view**:
    - Month view, grouped by weeks.
    - Each day shows its bookings as colored pills:
      - Amber: Pending
      - Green: Confirmed
      - Red: Cancelled
    - Clicking a booking opens its edit page in the Booking resource.
  - **Today’s bookings list**:
    - List of all bookings scheduled today, with time and status badge.
    - Each row is clickable and opens the edit booking form.

## Landing page

- Root path `/` shows a simple, Tailwind-styled landing page:
  - Brief description of BMMS and its purpose.
  - CTA to log in to the dashboard.
  - Sections about privacy, technology stack, and the developer.
- Uses Filament’s compiled CSS plus the project’s Tailwind build to provide a clean, modern presentation.
