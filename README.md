# Book Management App

This project is a Laravel 12 application for managing books. It demonstrates modern Laravel features, including the new `nestedWhere()` method for building complex query conditions.

## Features

- User authentication
- Book listing, search, and pagination
- Uses Laravel 12’s `nestedWhere()` for readable nested query conditions

## Laravel 12: `nestedWhere()` Feature

Laravel 12 introduces the `nestedWhere()` method, which allows you to group multiple conditions in a query more explicitly than using anonymous functions inside `where()`. This improves readability and maintainability for complex queries.

**Example:**

```php
Book::where('user_id', Auth::id())
    ->nestedWhere(
        'title', 'like', "%{$search}%",
        'or',
        'author', 'like', "%{$search}%"
    )
    ->latest()
    ->paginate(10);

This groups the search conditions for title and author using a dedicated method.


Installation
Clone the repository
Run composer install
Run npm install
Set up your .env file
Run migrations: php artisan migrate
Start the server: php artisan serve
Usage
Log in to your account
Search for books by title or author
Paginate through results
License
MIT
