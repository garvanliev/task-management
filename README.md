<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About

Laravel Project for Task Management

## Features

List the key features of the project.

- User - Create and manage my task and comments
- Admin - Create and manage my and all user tasks and comments
- Notification - Notify user when new comment is made by others on his task
- Notification - Notify user when task is due date

## Installation

1. Clone the repository:

    ```bash
    git clone <repository-url>
    ```

2. Navigate to the project directory:

    ```bash
    cd project-name
    ```

3. Install dependencies:

    ```bash
    composer install
    ```

5. Install JavaScript dependencies:

    ```bash
    npm install
    ```

6. Create a copy of the `.env.example` file and rename it to `.env`. Update the database connection and other necessary configuration options.

7. Generate an application key:

    ```bash
    php artisan key:generate
    ```

8. Run database migrations:

    ```bash
    php artisan migrate
    ```

9. Create admin user with terminal

    ```bash
    php artisan app:create-admin-user
    ```

## Usage

Create task and manage them with Title, Description, Due Date and Statuses.
Admin can manage and create task Statuses. Task Statuses needs to be created so user can choose from them when task is created.
Only admin can create new admin members. Users can register /register and log in /login.

## Configuration

Email notifications for new comment can be managed throug App\Listeners\UpdateUserAboutComment.php where developer can choose to use notification or mailable service. For perfomance can be enabled Queue jobs for these emails ( change to "class UpdateUserAboutComment implements ShouldQueue" ).
