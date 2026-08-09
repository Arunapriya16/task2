# Full-Stack PHP & MySQL Blog Application

A secure, full-stack web application built using **PHP** and **MySQL**, designed to demonstrate dynamic content management, user authentication, and robust database integration.

---

## 🌟 Key Features

* **User Authentication & Session Management:** Secure user registration, login system, password hashing, and active session handling.
* **Role-Based Authorization:** Structured access controls distinguishing standard users from administrative accounts.
* **Full CRUD Functionality:** Seamless capability to **Create, Read, Update, and Delete** blog posts with immediate database persistence.
* **Security & Best Practices:** 
  * PDO / Prepared Statements to prevent **SQL Injection**.
  * Input sanitization and `htmlspecialchars()` output escaping to prevent **Cross-Site Scripting (XSS)**.
  * Centralized configuration management for database connections.

---

## 🛠️ Tech Stack

* **Backend:** PHP (PDO)
* **Database:** MySQL
* **Frontend:** HTML5, CSS3
* **Server Environment:** Apache (via XAMPP)

---

## 🗄️ Database Setup

1. Open **phpMyAdmin** (`http://localhost/phpmyadmin/`).
2. Create a new database named `blog`.
3. Import the provided `schema.sql` file to set up the necessary tables and structure.
4. Ensure your database configuration in `db.php` matches your local server credentials:
   ```php
   $host = 'localhost';
   $dbname = 'blog';
   $username = 'root';
   $password = '';