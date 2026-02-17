# Professor Pritam Singh Website

A simple PHP website with Bootstrap 5 for Professor Pritam Singh, featuring books, articles, videos, and an admin panel for content management.

## Features

- **Plain PHP** - No frameworks required
- **Bootstrap 5.3.3** - Responsive design via CDN
- **JSON Storage** - File-based data storage (no database needed)
- **Admin Panel** - Complete CRUD operations for managing content
- **Security** - CSRF protection, XSS prevention, session management

## Requirements

- PHP 8.0 or higher
- Web server (Apache/Nginx) or PHP built-in server
- Writable permissions for `/data` directory

## Installation

1. Clone or download this repository
2. Ensure `/data` directory is writable by the web server
3. Update admin credentials in `login.php` before production use

## Running Locally

Using PHP's built-in server:

```bash
php -S 127.0.0.1:8080
```

Then visit: http://127.0.0.1:8080/index.php

## Admin Access

- **URL**: http://localhost:8080/login.php
- **Username**: `admin`
- **Password**: `CHANGE_ME_STRONG_PASSWORD`

⚠️ **Important**: Change the admin password before deploying to production!

## Directory Structure

```
.
├── index.php              # Homepage
├── about.php              # About page
├── books.php              # Books listing
├── articles.php           # Articles listing
├── videos.php             # Videos listing
├── contact.php            # Contact information
├── login.php              # Admin login
├── logout.php             # Admin logout
├── admin.php              # Admin dashboard
├── admin_books.php        # Manage books
├── admin_articles.php     # Manage articles
├── admin_videos.php       # Manage videos
├── header.php             # Header component
├── footer.php             # Footer component
├── functions.php          # Helper functions
├── /data/                 # JSON data files
│   ├── books.json
│   ├── articles.json
│   ├── videos.json
│   ├── bio.json
│   └── .htaccess         # Deny direct access
└── /assets/
    ├── /css/
    │   └── site.css      # Custom styles
    └── /img/             # Images directory
```

## Security Features

- **CSRF Protection**: All forms include CSRF tokens
- **XSS Prevention**: HTML escaping via `h()` function
- **Session Security**: Session regeneration on login, proper cleanup on logout
- **URL Validation**: All URLs validated with `FILTER_VALIDATE_URL`
- **Date Validation**: Date format validation for YYYY-MM-DD
- **File Locking**: JSON writes use `LOCK_EX` to prevent corruption
- **Directory Protection**: .htaccess prevents direct access to `/data`

## Production Deployment

Before deploying to production:

1. **Update Admin Password**
   - Edit `login.php`
   - Use password hashing (framework included in comments)
   
2. **File Permissions**
   - Ensure `/data` is writable by web server
   - Recommended: 755 for directories, 644 for files
   - `/data` contents: 600 or 640

3. **Web Server Configuration**
   - Enable .htaccess (if using Apache)
   - Or configure equivalent rules for Nginx
   - Enable HTTPS/SSL

4. **PHP Configuration**
   - Disable error display: `display_errors = Off`
   - Enable error logging: `log_errors = On`
   - Set appropriate timezone

5. **Security Headers** (add to .htaccess or web server config)
   ```
   X-Content-Type-Options: nosniff
   X-Frame-Options: SAMEORIGIN
   X-XSS-Protection: 1; mode=block
   ```

## Managing Content

### Adding Books

1. Log in to the admin panel
2. Go to "Manage Books"
3. Fill in the form with book details
4. Add purchase/reference links as needed
5. Click "Add Book"

### Adding Articles

1. Log in to the admin panel
2. Go to "Manage Articles"
3. Fill in title, source, date, and URL
4. Add a summary (optional)
5. Click "Add Article"

### Adding Videos

1. Log in to the admin panel
2. Go to "Manage Videos"
3. Fill in title, platform, URL, and other details
4. Click "Add Video"

## Customization

### Changing Colors

Edit `/assets/css/site.css` and modify the CSS variables:

```css
:root {
    --primary-color: #003366;
    --secondary-color: #006699;
}
```

### Updating Bio

Edit `/data/bio.json` with your information.

### Modifying Pages

All page content is in the respective PHP files. Edit them directly to update content.

## Troubleshooting

**Issue**: Pages show errors
- Check PHP version (requires 8.0+)
- Verify file permissions on `/data`

**Issue**: Changes not saving
- Ensure `/data` directory is writable
- Check web server error logs

**Issue**: Login not working
- Clear browser cookies
- Check session configuration in PHP

## Support

For issues or questions, refer to the development guide:
- `Professor_Pritam_Singh_Website_Dev_Guide.md`

## License

© 2026 Professor Pritam Singh. All rights reserved.
