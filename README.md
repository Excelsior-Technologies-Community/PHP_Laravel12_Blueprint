# PHP_LARAVEL12_BLUEPRINT
```php
Laravel 12 based Blueprint Code Generator Web Application built using clean MVC architecture and YAML driven development.
```
# Key Features
```php
- Blueprint Based Code Generation
- YAML Driven Development
- Fast CRUD Scaffolding
- Laravel 12 Compatible
- MVC Architecture Implementation
- API Ready Structure
- Beginner Friendly Blueprint Setup
- Clean Project Structure
```
# Step 1: Install Fresh Laravel 12 Application
Open Terminal / Command Prompt and run:
```php
composer create-project laravel/laravel:^12.0 PHP_Laravel12_Blueprint
```
Move into project directory:
```php
cd PHP_Laravel12_Blueprint
```
Generate application key:
```php
php artisan key:generate
```

# Explanation
```php
- Installs fresh Laravel 12 project
- Application key is required for encryption and session security
```

# Step 2: Configure Environment & Database
Open .env file and update database configuration:
```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=laravel12_blueprint_db
DB_USERNAME=root
DB_PASSWORD=
```
Run default migrations:
```php
php artisan migrate
```
# Explanation
```php
- .env manages environment configuration
- Default migrations create Laravel system tables
```

# Step 3: Install Laravel Blueprint Package
Install Blueprint Package:
```php
composer require -W --dev laravel-shift/blueprint
```

# Explanation
```php
- Installs Blueprint code generator
- Used to generate Laravel components using YAML draft file
```

# Step 4: Initialize Blueprint
Create Draft YAML File
```php
php artisan blueprint:new
```
These files are used by Blueprint to generate code.

# Step 5: Create Blueprint Draft Definition
Open draft.yaml
```php
models:
  Product:
    name: string
    price: integer
    description: text nullable

controllers:
  Product:
    index:
      query: all
      render: product.index with:products

    store:
      validate: name, price
      save: product
      redirect: product.index
```
# Step 6: Build Blueprint Components

Run:
```php
php artisan blueprint:build
```
# Explanation
```php
Reads draft.yaml and generates Laravel files automatically.
```

# Step 7: Run Generated Migration
```php
php artisan migrate
```

# Explanation
Creates products database table.

# Step 8: Blueprint Useful Commands
Rebuild Components
```php
php artisan blueprint:build
```

# Step 9: Run Laravel Project
Start Laravel development server:
```php
php artisan serve
```

# Step 10: Open Browser
Default Laravel Page
```php
http://127.0.0.1:8000
```
<img width="1200" height="599" alt="image" src="https://github.com/user-attachments/assets/494a3c82-6d23-4d00-9e91-42d0a9c6eb0f" />

Blueprint Generated CRUD Routes
```php
http://127.0.0.1:8000/test
```
<img width="873" height="385" alt="image" src="https://github.com/user-attachments/assets/84807cb1-aedc-42e1-93e8-b21aea227bb1" />

# Explanation
```php
- Runs Laravel locally
- Opens Blueprint generated CRUD application
```

# Project Folder Structure
```php
PHP_LARAVEL12_BLUEPRINT
├── app/
│   ├── Models/
│   │   └── User.php
│   └── Http/
│       └── Controllers/
│           └── ProductController.php
│
├── resources/
│   └── views/
│
├── routes/
│   └── web.php
│
├── database/
│   └── migrations/
│
├── draft.yaml
├── .env
├── artisan
└── composer.json
```




