
# Lab Activity 11 – Barangay Bulletin

Full-Stack Web Development  
Ateneo de Davao University

## Project Description

Barangay Bulletin – Purok Maligad is a Laravel web application for Barangay Matina Crossing, Davao City. It allows residents to view barangay announcements, filter posts, and submit comments after logging in. Kagawads can also create and publish new announcements.

This activity builds on Lab Activity 10 by adding Eloquent relationships, eager loading, manual authentication, and Form Request validation.

## Features

- Published announcements with pinned posts shown first
- Search posts by title
- Filter posts by category and tags
- Pagination with 7 posts per page
- Author profile pages showing posts and comments received
- Login and logout for Kagawad and resident accounts
- Comment submission for logged-in users
- Post creation restricted to users with author profiles
- Form Request validation with custom error messages
- Eager loading to prevent N+1 queries
- Responsive interface using Blade and Tailwind CSS

## Personalization

- Site: Barangay Bulletin – Purok Maligad
- Barangay: Matina Crossing, Davao City
- Author: Kagawad Trixia Maligad
- Resident: Lola Maligad
- Posts per page: 7
- Pinned post: Purok Maligad Birthday Celebration
- Birthday post date: September 16, 2026

## Seeded Login Accounts

| Account | Email | Password |
|---|---|---|
| Kagawad | kagawad.maligad@bulletin.test | bulletin2026 |
| Resident | lola.maligad@bulletin.test | bulletin2026 |

Passwords are hashed in the database. These are development-only test accounts.

## Tags

The application uses five tags:

1. Purok Maligad
2. Urgent
3. Libre
4. Schedule
5. Community

Posts are assigned tags using attach() and sync(). The pinned post has exactly Purok Maligad and Urgent.

## Eloquent Relationships

| Model | Relationship | Purpose |
|---|---|---|
| User → Author | hasOne | A user can have one author profile |
| User → Comment | hasMany | A user can write multiple comments |
| Author → User | belongsTo | An author profile belongs to a user |
| Author → Post | hasMany | An author can write multiple posts |
| Author → Comment | hasManyThrough | An author receives comments through their posts |
| Post → Author | belongsTo | Each post belongs to an author |
| Post → Comment | hasMany | Each post can have multiple comments |
| Post → Tag | belongsToMany | A post can have multiple tags |
| Comment → Post | belongsTo | Each comment belongs to a post |
| Comment → User | belongsTo | Each comment belongs to a user |
| Tag → Post | belongsToMany | A tag can be used by multiple posts |

The post_tag pivot table connects posts and tags. The author comments relationship uses posts as the intermediate model.

## Eager Loading

The post index uses with() to load authors and tags, and withCount() to retrieve comment counts.

Individual post pages use load() to retrieve authors, tags, and commenters.

Lazy loading prevention is enabled during development through AppServiceProvider.

## Form Validation

StoreCommentRequest checks that users are logged in and that comments contain 3–1000 characters.

StorePostRequest allows only users with an author profile to create posts. It validates the title, body, category, selected tags, and publication status.

The forms show validation errors and retain previous input using old().

## Installation

Clone the repository:

```bash
git clone https://github.com/tsmaligad/LabActivity11-Maligad.git
cd LabActivity11-Maligad
```

Install dependencies:

```bash
composer install
npm install
```

Create the environment file:

```powershell
Copy-Item .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Set DB_CONNECTION=sqlite in .env and create database/database.sqlite if it does not exist.

Run migrations and seed the database:

```bash
php artisan migrate:fresh --seed
```

Start the Laravel server:

```bash
php artisan serve
```

Start Vite in another terminal:

```bash
npm run dev
```

For Windows PowerShell, npm.cmd run dev can be used if npm.ps1 is blocked.

Open http://127.0.0.1:8000/posts in your browser.

## Testing

The application was tested for login, comment submission, form validation, author-only post creation, tag filtering, and relationship loading.

The seeded accounts allow testing of the difference between Kagawad and resident permissions.
