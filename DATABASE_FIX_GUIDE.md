# Database Connection Fix Guide

## Problem
The Laravel application is running outside Docker but trying to connect to MySQL using the Docker container hostname `restaurantsystem-mysql-1`, which fails with "No such host is known" error.

## Solution
Update your `.env` file to connect to the Docker MySQL container using localhost and the mapped port.

## Step 1: Update .env file

Open `RestaurantSystem\restaurant2\.env` and change these database settings:

```env
# FROM (Docker container hostname - doesn't work when Laravel runs outside Docker):
DB_HOST=restaurantsystem-mysql-1
DB_PORT=3306

# TO (Localhost with mapped port):
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=restaurant_db
DB_USERNAME=user
DB_PASSWORD=password
```

## Step 2: Complete .env Configuration

Make sure your complete database section looks like this:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=restaurant_db
DB_USERNAME=user
DB_PASSWORD=password
```

## Step 3: Clear Configuration Cache

After updating .env, run:

```bash
php artisan config:clear
php artisan config:cache
```

## Step 4: Test Database Connection

Run this command to test the connection:

```bash
php artisan tinker --execute="echo 'Menu items: ' . \App\Models\MenuItem::count();"
```

## Step 5: Run Migrations (if needed)

If tables don't exist, run:

```bash
php artisan migrate
```

## Step 6: Seed Test Data (optional)

Create some test menu items and orders:

```bash
php artisan db:seed --class=DemoOrderSeeder
```

## Alternative: Run Laravel Inside Docker

If you prefer to keep the current .env settings, you can run Laravel inside Docker instead:

1. Create a PHP container that shares the network with MySQL
2. Run Laravel commands from inside the container
3. Access the app through the Docker network

## Verification

Once fixed, the checkout should work properly. You can test by:

1. Going to the menu page
2. Adding items to cart
3. Clicking checkout
4. Filling out customer information
5. Submitting the order

The order should now save successfully and appear in the admin panel under "Pending Orders".

## Troubleshooting

If you still get errors:

1. **Check Docker containers are running:**
   ```bash
   docker-compose ps
   ```

2. **Test direct MySQL connection:**
   ```bash
   mysql -h 127.0.0.1 -P 3307 -u user -p restaurant_db
   ```

3. **Check Laravel logs:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

4. **Verify port mapping:**
   ```bash
   netstat -an | findstr 3307
   ```

The key fix is changing `DB_HOST=restaurantsystem-mysql-1` to `DB_HOST=127.0.0.1` and `DB_PORT=3306` to `DB_PORT=3307` in your `.env` file.