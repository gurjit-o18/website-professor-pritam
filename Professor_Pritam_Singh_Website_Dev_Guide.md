# README.md --- Infrastructure + Dev Guide

Project: Professor Pritam Singh (Oxford) --- Simple PHP + Bootstrap
Website

## Core Requirements

-   Plain PHP (no frameworks)
-   Latest Bootstrap via CDN
-   All PHP files in root directory
-   JSON-based storage (no database)
-   Static admin login (inside PHP file)
-   Simple CRUD via UI
-   Clean, readable, well-commented code

------------------------------------------------------------------------

## Folder Structure

Root: - index.php - about.php - books.php - articles.php - videos.php -
contact.php - login.php - logout.php - admin.php - admin_books.php -
admin_articles.php - admin_videos.php - header.php - footer.php -
functions.php

Folders: - /data/ - books.json - articles.json - videos.json -
bio.json - /assets/css/site.css - /assets/img/

------------------------------------------------------------------------

## Bootstrap Integration

Use Bootstrap 5.x via CDN in header.php:

CSS:
https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css

JS:
https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js

UI Requirements: - Responsive navbar - Hero section on homepage - Card
layouts for books/articles/videos - Bootstrap tables in admin - Alerts
for success/error - Clean footer

------------------------------------------------------------------------

## JSON Structure

### books.json

{ "items": \[ { "id": "b_001", "title": "Book Title", "authors": "Pritam
Singh", "year": 2010, "publisher": "Publisher", "isbn": "978XXXXXXXX",
"links": \[ { "label": "Amazon", "url": "https://..." } \], "notes":
"Optional notes" } \] }

### articles.json

{ "items": \[ { "id": "a_001", "title": "Article Title", "source":
"Journal Name", "date": "2019-11-05", "url": "https://...", "summary":
"Short summary" } \] }

### videos.json

{ "items": \[ { "id": "v_001", "title": "Interview Title", "platform":
"YouTube", "url": "https://youtube.com/...", "published_date":
"2024-11-20", "duration": "26:16", "channel": "Channel Name", "notes":
"Optional" } \] }

------------------------------------------------------------------------

## Required Helper Functions (functions.php)

-   read_json(\$path)
-   write_json(\$path, \$data)
-   h(\$string) for HTML escape
-   is_logged_in()
-   require_login()
-   csrf_token()
-   csrf_check()
-   new_id(\$prefix)

Validation: - Required title - Valid URL using FILTER_VALIDATE_URL -
Date format YYYY-MM-DD - Unique IDs

------------------------------------------------------------------------

## Admin Authentication

Inside login.php:

\$ADMIN_USER = "admin"; \$ADMIN_PASS = "CHANGE_ME_STRONG_PASSWORD";

Use PHP sessions: On success: \$\_SESSION\['admin'\] = true;

Logout: session_destroy();

------------------------------------------------------------------------

## Admin CRUD

Each admin page must: - Display add form - Display list table - Provide
Edit & Delete buttons - Use POST for changes - Protect with CSRF token -
Update JSON file using LOCK_EX

------------------------------------------------------------------------

## Homepage Layout

-   Hero section with intro
-   3 feature cards (Books, Articles, Videos)
-   Latest updates section (last 5 items)
-   Footer

------------------------------------------------------------------------

## Deployment Notes

-   Ensure /data is writable
-   Protect /data with .htaccess if using Apache
-   Local run: php -S 127.0.0.1:8080

------------------------------------------------------------------------

## Implementation Order

1.  Create structure
2.  Add header + footer
3.  Build helper functions
4.  Create public pages
5.  Create admin pages
6.  Add sample JSON
7.  Test CRUD
8.  Deploy

------------------------------------------------------------------------

## Done Definition

-   Responsive UI
-   Working login
-   Working CRUD
-   Valid JSON updates
-   All PHP files in root
