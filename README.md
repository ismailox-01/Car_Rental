# 🚗 Premium Car Rental Management System

[![Laravel Version](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

A high-end, full-stack car rental platform designed for luxury and performance. This project features a sophisticated user interface with modern aesthetics, glassmorphism, and interactive 3D animations, powered by Laravel 12 and GSAP.

---

## ✨ Key Features

### 💎 Premium Frontend Experience
- **Luxury Aesthetic**: Deep Obsidian & Champagne Gold theme with glassmorphism panels.
- **Interactive UI**: GSAP-powered 3D tilt effects on vehicle cards and smooth scroll animations.
- **Dynamic Dark Mode**: Intelligent theme switching that persists via local storage.
- **Responsive Design**: Fully optimized for mobile, tablet, and desktop using Bootstrap 5 and Tailwind CSS.

### 👤 Customer Features
- **Advanced Fleet Search**: Filter by brand, vehicle class, transmission, and fuel type.
- **Seamless Booking**: Streamlined reservation process with real-time availability checks.
- **User Dashboard**: Manage profiles, view booking history, and cancel active reservations.
- **PDF Confirmations**: Automated generation of booking invoices and details using `laravel-dompdf`.
- **Payment Integration**: Secure payment processing workflow (simulated/extendable).

### 🛡️ Administrative Power
- **Intuitive Dashboard**: Real-time statistics and overview of business performance.
- **Fleet Management**: Full CRUD operations for vehicles, including availability toggles.
- **Booking Oversight**: Monitor and update booking statuses (Pending, Confirmed, Cancelled).
- **User & Location Management**: Comprehensive control over registered users and rental pickup points.
- **Contact Center**: Integrated system to manage and respond to customer inquiries.

---

## 🛠️ Technology Stack

| Layer | Technologies |
| :--- | :--- |
| **Backend** | Laravel 12, PHP 8.2+, Eloquent ORM |
| **Frontend** | Blade Templates, Tailwind CSS 4, Bootstrap 5, Alpine.js |
| **Animations** | GSAP 3 (ScrollTrigger, 3D Tilt) |
| **Database** | SQLite (Default), Support for MySQL/PostgreSQL |
| **Tools** | Vite, Composer, NPM |

---

## 🚀 Getting Started

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & NPM
- SQLite (or your preferred database)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/voiture-2.git
   cd voiture-2
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**
   By default, the project uses SQLite. The `setup` command handles this for you:
   ```bash
   touch database/database.sqlite
   php artisan migrate --seed
   ```

5. **Compile Assets**
   ```bash
   npm run dev
   ```

6. **Start the Server**
   ```bash
   php artisan serve
   ```

---

## 📁 Project Structure

- `app/Http/Controllers/Admin/`: Contains admin-specific logic for fleet and booking management.
- `resources/views/`:
    - `cars/`: Public vehicle listing and detail views.
    - `bookings/`: Customer reservation workflow.
    - `admin/`: Premium administrative dashboard and management views.
- `routes/web.php`: Defined routes for public, customer, and administrative access.

---

## 🔒 Security

- Integrated **reCAPTCHA** protection for contact forms and authentication.
- **Role-Based Access Control (RBAC)**: Strict middleware-protected routes for admin and customer areas.
- **CSRF Protection**: Standard Laravel security headers implemented across all forms.

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

---

<p align="center">
  Developed with ❤️ for a Premium Driving Experience
</p>
