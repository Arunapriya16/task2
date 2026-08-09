# PHP & MySQL Web Application

## Description
A full-stack web application built using PHP and MySQL featuring user authentication, role-based access control, and complete CRUD functionality for managing blog posts.

## Features
- **User Authentication:** Registration, login, session control, and password hashing.
- **Role-Based Authorization:** Custom access levels for Admins and standard users.
- **CRUD Operations:** Create, read, edit, and delete posts.
- **Security:** MySQLi prepared statements (SQL injection protection) and HTML output escaping (XSS protection).

## Database Setup
1. Import `schema.sql` into MySQL / phpMyAdmin.
2. Ensure database configuration matches credentials in `db.php`.

## How to Run
1. Place project files in `C:\xampp\htdocs\blog\`.
2. Start Apache and MySQL from the XAMPP Control Panel.
3. Access the application at `http://localhost/blog/index.php`.