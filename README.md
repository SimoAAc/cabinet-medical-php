# Cabinet Medical (First PHP Project)

A simple medical office management web app built with **PHP and MySQL** as one of my first web development projects.

## Features
- Secretary login (session-based)
- Manage doctors (médecins), patients, and appointments (rendez-vous)
- Appointment planning view
- Basic MVC-style structure (controllers/models/views)

## Tech stack
- PHP
- MySQL (MariaDB)
- HTML/CSS

## Project structure
```text
cabinet-medical-php/
├── index.php
├── assets/
├── config/
├── controllers/
├── database/
│   └── cabinet_medical.sql
├── models/
├── views/
├── create_secretary.php
└── presentation/
```

## Getting started (XAMPP / WAMP)

### 1) Put the project in your web root
- XAMPP (Windows): copy the folder into `htdocs/` (e.g. `htdocs/cabinet-medical-php`)
- WAMP: copy into `www/`

### 2) Create the database
1. Open phpMyAdmin (usually `http://localhost/phpmyadmin`).
2. Create a database named `cabinet_medical`.
3. Import `database/cabinet_medical.sql`.

### 3) Configure database connection
Check `config/Database.php`. By default it uses:
- Host: `localhost`
- Database: `cabinet_medical`
- User: `root`
- Password: *(empty)*

Update these values if your MySQL setup is different.

### 4) Create the secretary account (one time)
Open in your browser:
```text
http://localhost/cabinet-medical-php/create_secretary.php
```
This creates a demo account (from the script):
- **Username:** `secretaire`
- **Password:** `Secret2026!`

> Security note: after creating the account, **delete or protect** `create_secretary.php` (don’t leave it accessible in production).

### 5) Run the app
Open:
```text
http://localhost/cabinet-medical-php/
```
Log in with the credentials above.

## Presentation
A PDF is included in `presentation/` (MCD/MLD/classes diagram notes).

## Notes
- This is an early learning project (kept as-is for portfolio/history).
- Improve security before any real use (input validation, CSRF, stronger auth, etc.).

## License
No license specified (all rights reserved by default). Add a `LICENSE` file if you want to make it open source.