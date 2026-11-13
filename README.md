# Lab Activity 10 – Barangay Bulletin

**Full-Stack Web Development**  
Ateneo de Davao University

## Project Description

Barangay Bulletin – Purok Maligad is a Laravel-based web application developed for Barangay Matina Crossing in Davao City. The application allows residents to browse barangay announcements, search for posts by title, filter posts by category, and view individual announcements.

The project demonstrates the use of Eloquent ORM, database migrations, factories, seeders, query builder filtering, pagination, and Blade with Tailwind CSS.

## Features

- Published barangay announcements with pinned posts displayed first
- Title search and category filtering
- Individual post pages with view counters
- Pagination with seven posts per page
- Draft posts excluded from public listings
- Responsive Blade and Tailwind CSS interface
- SQLite database with Faker-generated sample records

## Personalization

- **Site Title:** Barangay Bulletin – Purok Maligad
- **Personalized Author:** Kagawad Trixia Maligad
- **Email:** kagawad.maligad@bulletin.test
- **Posts Per Page:** 7, based on the seven letters in "Maligad"
- **Custom Category:** Community Events
- **Pinned Post:** Purok Maligad Clean-up Drive
- **Birthday Post Date:** September 16, 2026 

## Database Records

The database is populated using Laravel factories and seeders.

- 5 authors, including the manually created Kagawad
- 40 published posts generated using Faker
- 10 draft posts generated using the `draft()` factory state
- 1 manually created pinned clean-up drive announcement
- 51 posts in total

## Installation and Setup

**Requirements:** PHP compatible with the project's Composer dependencies, Composer, Node.js, npm, and SQLite support.

1. Clone the repository:

   ```bash
   git clone https://github.com/tsmaligad/LabActivity10-Maligad.git
   cd LabActivity10-Maligad
   ```

2. Install PHP dependencies:

   ```bash
   composer install
   ```

3. Copy the environment configuration:

   **Windows PowerShell:**
   ```powershell
   Copy-Item .env.example .env
   ```

   **macOS/Linux:**
   ```bash
   cp .env.example .env
   ```

4. Generate the application key:

   ```bash
   php artisan key:generate
   ```

5. Set `DB_CONNECTION=sqlite` in `.env` and create `database/database.sqlite` if it does not exist.

6. Run migrations and seed the database:

   ```bash
   php artisan migrate:fresh --seed
   ```

7. Install frontend dependencies:

   ```bash
   npm install
   ```

8. Start the Vite development server:

   ```bash
   npm run dev
   ```

9. In a separate terminal, start Laravel:

   ```bash
   php artisan serve
   ```

10. Open `/posts` in your browser.

## Database and Eloquent Verification

The project includes reversible migrations, a separate migration for the post view counter, and Eloquent models with explicitly defined fillable attributes.

The required ActiveRecord demonstration uses `Post::find()`, modifies a post's title, saves it with `save()`, and retrieves the updated value.

Evidence: `docs/tinker.png`

## Technologies Used

- Laravel
- PHP
- SQLite
- Eloquent ORM
- Blade
- Tailwind CSS
- Vite
- Faker