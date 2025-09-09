# Diceware PHP Application

This is a Laravel Lumen 5.0 microframework application that implements a diceware password generator. The application downloads the diceware wordlist and provides a web interface for password generation.

Always reference these instructions first and fallback to search or bash commands only when you encounter unexpected information that does not match the info here.

## Working Effectively

**CRITICAL COMPATIBILITY NOTICE**: This Laravel 5.0 application was designed for PHP 5.4-5.6 but we're running on PHP 8.3. The web application works, but console commands (artisan) and tests have compatibility issues.

### Bootstrap and Dependencies
- **NEVER CANCEL**: Dependency installation takes 15-20 seconds. Set timeout to 60+ seconds.
- Install dependencies: `composer install --ignore-platform-reqs --no-interaction`
  - **REQUIRED FLAGS**: `--ignore-platform-reqs` bypasses PHP version constraints
  - **REQUIRED FLAGS**: `--no-interaction` prevents GitHub token prompts
  - You may need to run: `composer config --no-plugins allow-plugins.kylekatarnls/update-helper true`

### Environment Setup
- Copy environment file: `cp .env.example .env`
- Configure for SQLite database by editing `.env`:
  ```
  DB_CONNECTION=sqlite
  DB_DATABASE=storage/app/database.sqlite
  ```
- Set up database: `cp storage/app/database.sqlite.dist storage/app/database.sqlite`

### Web Application
- **WORKS**: Start web server: `php -S localhost:8000 server.php`
- **WORKS**: Access application at http://localhost:8000
- **WORKS**: Returns "Hello World" on GET /
- The web application runs successfully despite PHP version incompatibility

### Console Commands (Artisan) - **DO NOT WORK**
- **BROKEN**: `php artisan migrate` - fails with PHP 8.3 compatibility errors
- **BROKEN**: `php artisan util:importData` - fails with PHP 8.3 compatibility errors  
- **BROKEN**: `php artisan migrate:status` - fails with PHP 8.3 compatibility errors
- **REASON**: Laravel 5.0 uses deprecated PHP methods incompatible with PHP 8.3

### Testing - **DO NOT WORK**
- **BROKEN**: `./vendor/bin/phpunit` - fails due to deprecated `each()` function
- **BROKEN**: `./vendor/bin/behat` - fails with missing dependencies and PHP 8.3 issues
- **REASON**: PHPUnit 4.8 and Behat 3.4 are incompatible with PHP 8.3

## Validation

### Manual Validation Steps
Always manually validate any new code changes:

1. **Test Web Application**:
   ```bash
   php -S localhost:8000 server.php &
   sleep 2
   curl -f http://localhost:8000/
   # Should return: Hello World
   ```

2. **Test Database Setup**:
   ```bash
   ls -la storage/app/database.sqlite
   # Should show the database file exists
   ```

3. **Test Environment Configuration**:
   ```bash
   grep "DB_CONNECTION=sqlite" .env
   grep "DB_DATABASE=storage/app/database.sqlite" .env
   # Both should return matches
   ```

### What You Cannot Do
- **DO NOT** try to run artisan commands - they will fail
- **DO NOT** try to run tests - they will fail  
- **DO NOT** try to use `php artisan migrate` - use manual database setup instead
- **DO NOT** expect console commands to work without significant compatibility fixes

### What You Can Do
- Start and test the web application
- Modify web routes and controllers
- Update the web interface
- Make changes to the Diceware importer class (src/Importer/Diceware.php)
- Test web functionality manually via curl or browser

## Repository Structure

### Key Directories
- `app/` - Laravel application code (Console, HTTP, Providers)
- `src/Importer/` - Diceware wordlist importer classes
- `public/` - Web server document root
- `storage/app/` - Application storage including SQLite database
- `tests/` - PHPUnit tests (non-functional due to PHP 8.3)
- `features/` - Behat feature tests (non-functional due to PHP 8.3)
- `vendor/` - Composer dependencies

### Key Files
- `server.php` - Development web server entry point
- `public/index.php` - Web application entry point
- `artisan` - Laravel console application (non-functional)
- `composer.json` - Dependencies (modified to work with PHP 8.3)
- `.env` - Environment configuration
- `app/Http/routes.php` - Web routes definition

### Database
- Uses SQLite: `storage/app/database.sqlite`
- Migration: `database/migrations/2015_04_21_195843_create_diceware_table.php`
- Creates `diceware` table with `id` (5 chars) and `word` (6 chars) columns

## Common Tasks

### Starting Development
1. Run bootstrap steps (see above)
2. Start web server: `php -S localhost:8000 server.php`
3. Test basic functionality: `curl http://localhost:8000/`

### Making Changes
1. Edit files in `app/`, `src/`, or `public/`
2. Test web application manually
3. **ALWAYS** verify the web server still starts and responds

### File Listings (for reference)

#### Repository Root
```
.env.example       - Environment template
.gitignore        - Git ignore rules  
.scrutinizer.yml  - Code quality config
.travis.yml       - CI configuration (for PHP 5.4-5.6)
app/              - Laravel app code
artisan           - Laravel console (broken)
bootstrap/        - Laravel bootstrap
build/            - CI scripts
composer.json     - Dependencies
database/         - Migrations
features/         - Behat tests (broken)
phpunit.xml       - PHPUnit config (broken)
public/           - Web document root
readme.md         - Project documentation
server.php        - Development server
src/              - Custom application code
storage/          - Application storage
tests/            - PHPUnit tests (broken)
```

#### Application Structure
```
app/Console/Commands/ImportData.php  - Data import command (broken)
app/Http/routes.php                  - Web routes (GET / returns "Hello World")
src/Importer/Diceware.php          - Diceware wordlist importer class
public/index.php                    - Web application entry point
storage/app/database.sqlite         - SQLite database
```

## Timing Expectations

- **Composer install**: 15-20 seconds (NEVER CANCEL - set 60+ second timeout)
- **Web server startup**: Immediate (< 1 second)
- **Web request response**: Immediate (< 1 second)
- **File operations**: Immediate (< 1 second)

## Compatibility Summary

| Component | Status | Notes |
|-----------|--------|-------|
| Web Application | ✅ WORKS | Serves "Hello World" successfully |
| Composer Install | ✅ WORKS | With `--ignore-platform-reqs` flag |
| Environment Setup | ✅ WORKS | Manual file copying |
| Database Setup | ✅ WORKS | Manual file copying |
| Artisan Commands | ❌ BROKEN | PHP 8.3 compatibility issues |
| PHPUnit Tests | ❌ BROKEN | Uses deprecated functions |
| Behat Tests | ❌ BROKEN | PHP 8.3 compatibility issues |
| CI/CD (.travis.yml) | ❌ BROKEN | Designed for PHP 5.4-5.6 |

## Emergency Procedures

If you encounter issues:

1. **Web server won't start**: Check if port 8000 is already in use
2. **Database errors**: Verify `storage/app/database.sqlite` exists and is writable
3. **Composer fails**: Ensure you're using `--ignore-platform-reqs --no-interaction` flags
4. **Permission errors**: Check file permissions in `storage/` directory

## Development Workflow

When making changes to this codebase:

1. **ALWAYS** test the web application after changes
2. **NEVER** rely on artisan commands or automated tests
3. Use manual testing and validation procedures
4. Focus on web functionality as that's what works
5. Remember this is a legacy codebase with modern PHP compatibility issues