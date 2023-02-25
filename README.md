# How to run the project

## 1. Install dependencies 
```bash
    composer install
    npm install
```

## 2. Configure database in .env file 

```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=article_system
    DB_USERNAME=root
    DB_PASSWORD=
```

## 3. Run migrations and seed authors table
```bash
    php artisan migrate
    php artisan db:seed --class=AuthorSeeder
```
## 4. Run php and vite servers

```bash
    php artisan serve --port=8000
    npm run dev
```
---
Application should be avaiable at localhost:8000 🙂
