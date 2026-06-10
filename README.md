# AzuraShop - Laravel E-Commerce System

**Developer:** Eren İşitmez (20222022407)

AzuraShop is a modern, responsive, and feature-rich e-commerce web application built with **Laravel 12**, styled using **Tailwind CSS v4**, and bundled with **Vite**. It features an elegant front-end shopping interface with seamless AJAX/standard cart interactions, product search autocomplete, product quick views, coupon discounts, order tracking, and a comprehensive administration dashboard for managing categories, products, orders, sliders, settings, and users.

---

## About the Project

AzuraShop is designed to be a lightweight yet robust e-commerce template that bridges the gap between high-performance client experience and clean administrative workflows. The project uses modern standard patterns in Laravel development:

* **MVC Pattern & Service Layer:** The application utilizes standard Laravel controllers separating front-facing customer requests from the back-office admin dashboard logic.
* **Eloquent ORM Relationships:** The database schema links categories, products, orders, order items, coupons, settings, and users through dynamic, highly optimized relations (e.g., Categories support multi-level parenting, and Products link to Users as authors).
* **Vibrant Front-end Experience:** Combining Tailwind CSS v4's high-speed compiler with Vite ensures rapid page load times and dynamic components. Vanilla JavaScript and Axios are utilized to manage real-time interactions such as live cart updates, search autocomplete previews, and modal quick views without reloading pages.
* **Administrative Operations:** The admin interface features secure access via custom middleware, enabling admins to track sales, update order fulfillment status, manage stock limits, create promotional sliders, and monitor user accounts.
* **Modern Development Tools:** The project incorporates Laravel 12 features, along with `laravel/boost`, `laravel/pail` for debugging, and Pest PHP for rapid testing workflows.

---

## Key Features

### Front-End / Customer Side
- **Localization / Multi-language Support:** Easily toggle between languages (`/lang/{locale}`).
- **Interactive Shop:** Browse products by categories, search dynamically with autocomplete, and filter items.
- **AJAX Quick View:** Click products to instantly open a detailed modal preview without page reloads.
- **Advanced Shopping Cart:** Supports both full-page cart and quick AJAX actions (add, update, remove, and counts).
- **Coupon Management:** Apply discount codes (percentage-based or fixed amounts) at checkout.
- **Seamless Checkout:** Simple shipping and billing forms that convert the shopping cart into orders.
- **User Profiles & Auth:** Register, login, logout, and customer profile pages.

### Back-End / Admin Panel (`/admin`)
- **Admin Dashboard:** Access analytics summary and main operations.
- **Category Management:** Create, read, update, and delete multi-level product categories.
- **Product Management:** Complete catalog management, stock levels, minimum stock alerts, discount rates, and image uploads.
- **Order Processing:** Track orders, view details, modify status (Pending, Shipped, Completed), and delete records.
- **User Administration:** Manage accounts, update user details and roles (Admin/User), and delete profiles.
- **Homepage Slider:** Dynamic slider manager to update front-end promotional banners.
- **System Settings:** Configure site metadata (name, email, phone, address), currency symbols, shipping fees, free shipping thresholds, and social media links.

---

## Technical Stack

- **Framework:** Laravel 12.x
- **PHP Version:** PHP 8.2+
- **Styling:** Tailwind CSS v4
- **Bundler:** Vite
- **Database:** MySQL (default active connection in `.env`), SQLite, or PostgreSQL
- **Testing:** Pest PHP
- **Developer Tools:** Laravel Tinker, Laravel Boost, Laravel Pail, Laravel Pint, Laravel Sail

---

## Installation & Setup

Follow these steps to set up the project locally:

### Prerequisites
Ensure you have the following installed on your machine:
- **PHP** (>= 8.2) or **XAMPP** (which includes PHP, Apache, and MySQL)
- **Composer**
- **Node.js** (includes npm)
- **Database engine:** MySQL / MariaDB (provided via XAMPP) or SQLite / PostgreSQL

### Step 1: Clone and Navigate
Clone the repository to your local directory and navigate into it:
```bash
git clone <repository-url> laravelProject
cd laravelProject
```

### Step 2: Database Setup (via XAMPP & phpMyAdmin)
If you are using XAMPP for local development:
1. Open the **XAMPP Control Panel** and start **Apache** and **MySQL**.
2. Open your browser and navigate to **phpMyAdmin** (`http://localhost/phpmyadmin`).
3. Create a new database named `azurashop` with `utf8mb4_unicode_ci` collation.
4. Ensure your `.env` file database settings match your local environment credentials (default XAMPP credentials):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=azurashop
   DB_USERNAME=root
   DB_PASSWORD=
   ```

### Step 3: Running Setup Script
The project includes a custom Composer setup command that streamlines installation by automating dependency installation, environment setup, key generation, migration execution, and asset building:
```bash
composer setup
```
This single command runs:
1. `composer install` (Installs all PHP packages)
2. Copies `.env.example` to `.env` (if not already present)
3. `php artisan key:generate` (Generates application key)
4. `php artisan migrate --force` (Runs database migrations)
5. `npm install` (Installs Node dependencies)
6. `npm run build` (Compiles frontend assets using Vite & Tailwind CSS v4)

### Step 4: Populate Database (Seeders)
To populate the database with default settings, categories, products, sliders, coupons, and sample users, run the database seed command:
```bash
php artisan db:seed
```

### Step 5: Run the Application
To launch the application local servers (including Laravel's built-in server, queue listener, and Vite's dev server) concurrently:
```bash
composer dev
```
Alternatively, you can run them individually:
```bash
# Start Laravel development server
php artisan serve

# Start Vite compilation in hot-reload mode
npm run dev

# Start processing job queues
php artisan queue:listen
```

Access the application in your browser at: `http://localhost:8000`

---

## Default Accounts (Seeded)

The database seeder configures the following default users:

### Admin Account
- **Email:** `admin@admin.com`
- **Password:** `admin123`
- **Dashboard URL:** `http://localhost:8000/admin`

### Customer Account
- **Email:** `user@user.com`
- **Password:** `user123`

---

## Sample Coupons (Seeded)
Use these coupon codes during checkout to test discount logic:
- **`AZURA10`**: Provides a **10%** discount on total cart value.
- **`WELCOME20`**: Provides a flat **$20.00** discount.

---

## Running Tests
To run unit and integration tests using Pest PHP:
```bash
composer test
```
This command clears configurations and executes the Pest test suite.

---

## Project Structure
Key directories of interest:
- `app/Http/Controllers/` - Contains Controllers for Frontend, Admin Panel, and API handlers.
- `app/Models/` - Database Eloquent models (User, Product, Category, Order, OrderItem, Coupon, Slider, Setting).
- `database/migrations/` - Database schema definitions.
- `routes/web.php` - Web routes mapping all front-end pages, API endpoints, and admin panels.
- `resources/views/` - Blade templates for the application view layer.
- `vite.config.js` - Configuration for Vite asset compilation.
