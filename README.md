# Professor Pritam Singh Website

A simple PHP website with Bootstrap 5 for Professor Pritam Singh, featuring books, articles, videos, and an admin panel for content management.

## Features

- **Plain PHP** - No frameworks required
- **Bootstrap 5.3.3** - Responsive design via CDN
- **JSON Storage** - File-based data storage (no database needed)
- **Admin Panel** - Complete CRUD operations for managing content
- **Security** - CSRF protection, XSS prevention, session management
- **Static Site Generation** - Automated GitHub Action generates static HTML from PHP pages

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
├── generate-static.php    # Static site generator script
├── /.github/
│   └── /workflows/
│       ├── static-site.yml # GitHub Action for static site generation
│       └── deploy-pages.yml # GitHub Action for GitHub Pages deployment
├── /data/                 # JSON data files
│   ├── books.json
│   ├── articles.json
│   ├── videos.json
│   ├── bio.json
│   └── .htaccess         # Deny direct access
├── /assets/
│   ├── /css/
│   │   └── site.css      # Custom styles
│   └── /img/             # Images directory
└── /static-website/       # Auto-generated static HTML (by GitHub Action)
    ├── *.html            # Static HTML pages
    ├── /assets/          # Copied assets
    └── /data/            # Copied JSON data
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

## Static Website Generation

The repository includes an automated GitHub Action that generates a static HTML version of the website. This feature is useful for deploying to static hosting services like GitHub Pages, Netlify, or Vercel.

### How It Works

1. **Automatic Generation**: The workflow runs automatically on every push and pull request
2. **PHP to HTML**: Converts PHP pages to static HTML files
3. **Link Conversion**: All `.php` links are automatically converted to `.html`
4. **Asset Copying**: Copies all assets (CSS, images) and data files
5. **Output Location**: Generated files are saved to `/static-website/` directory

### Manual Generation

To generate the static website manually:

```bash
php generate-static.php
```

This will:
- Start a temporary PHP server
- Fetch each public page
- Convert all links from `.php` to `.html`
- Copy assets and data directories
- Save everything to `/static-website/`

### Deployment Options

The generated static website in `/static-website/` can be deployed to:

- **GitHub Pages**: Automatically deployed via GitHub Action (see below)
- **Netlify**: Point to the `/static-website` directory
- **Vercel**: Deploy the `/static-website` folder
- **Any static host**: Upload the contents of `/static-website/`

### GitHub Pages Deployment

This repository is configured to automatically deploy the `/static-website/` directory to GitHub Pages:

1. **Automatic Deployment**: When changes are pushed to `/static-website/`, the GitHub Action automatically deploys to GitHub Pages
2. **Manual Trigger**: You can manually trigger the deployment from the Actions tab
3. **Enable GitHub Pages**:
   - Go to your repository Settings > Pages
   - Under "Build and deployment", select "GitHub Actions" as the source
   - The site will be available at `https://<username>.github.io/<repository-name>/`

The deployment workflow (`.github/workflows/deploy-pages.yml`) will:
- Trigger automatically when `/static-website/**` files change
- Deploy only the contents of the `/static-website/` directory
- Use GitHub's official Pages deployment actions for reliability

### What Gets Generated

- All public pages (index, about, books, articles, videos, contact)
- All assets (CSS, images)
- JSON data files
- `.nojekyll` file (for GitHub Pages)

**Note**: Admin pages (login, admin panels) are not included in the static generation as they require PHP functionality.

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
