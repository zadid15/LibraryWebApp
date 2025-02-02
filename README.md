# LibraryWebApp

## Overview

LibraryWebApp is a web-based library management system designed for efficient book reservations and catalog management. The application ensures that only **admins and staff** have access to manage books, reservations, and user data.

## Features

- **Book Management**: Add, update, and remove books from the library catalog.
- **Reservation System**: Members can request book reservations, which are managed by staff.
- **User Role Management**: Only admins and staff have full control over the system.
- **Authentication & Authorization**: Secure login system using Laravel Filament.
- **Search & Filter**: Easily find books by title, author, genre, or ISBN.

## Features

- **Book Management** – Add, update, and remove books from the library catalog.
- **Reservation System** – Members can request book reservations, managed by staff.
- **User Role Management** – Admins and staff have full system control, while members can reserve books.
- **Authentication & Authorization** – Secure login using **Laravel Filament**.
- **Search & Filter** – Easily find books by title, author, or genre.
- **Fine Management** – Track overdue books and manage fines.

## Technology Stack

- **Frontend**: Filament Admin Panel (Powered by Laravel Livewire)
- **Backend**: Laravel with MySQL database
- **Authentication**: Filament's built-in authentication system

## Installation

1. **Clone the repository:**
   ```sh
   git clone https://github.com/zadid15/LibraryWebApp.git
   ```
2. **Install dependencies:**
   ```sh
   composer install
   npm install
   ```
3. **Configure the environment:**
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```
4. **Set up the database:**
   ```sh
   php artisan migrate
   ```
5. **Start the development server:**
   ```sh
   php artisan serve
   ```

## Usage

- **Admins and staff** can log in via Filament at `/admin` to manage books and reservations.
- **Users** can browse available books and request reservations.

## Contribution

If you’d like to contribute, please follow these steps:

1. Fork the repository.
2. Create a new branch (`feature/new-feature`).
3. Commit changes and push to your fork.
4. Submit a pull request.

## License

This project is licensed under the **MIT License**.

