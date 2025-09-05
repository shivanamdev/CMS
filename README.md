# Professional Content Management System (CMS)

---

## Project Description

This project is a **full-stack Content Management System (CMS)** built with **Laravel 10**, TailwindCSS, and AlpineJS.  
It provides a modern **admin panel** for managing articles and a responsive frontend for viewing content.  

### Key Features:

1. Authentication
•       Admin login page (username & password).
•       Only logged-in admins can access the CMS dashboard.
2. Admin Panel
•       List all articles with Edit and Delete buttons.
•       Add New Article form.
•       Edit Article form.
•       Delete confirmation.
3. Public View
•       Show all articles in a simple list with title & content.
•       Clicking a title shows the full article on its own page.


---

## Requirements

- PHP >= 8.1  
- Composer  
- Node.js + npm  
- MySQL / MariaDB  
- Laravel 10  
- Git  

---

## Installation

1. **Clone the repository**

```bash

git clone https://github.com/shivanamdev/project-name.git

cd project-name
Install PHP dependencies via Composer


composer install
Install Node dependencies


npm install
npm run dev

.env file
cp .env.example .env

Generate application key: php artisan key:generate

Configuration Open:  .env and set your database credentials:

env:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cms_db
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
Also set the APP_URL:

env: 
APP_URL=http://127.0.0.1:8000
Database Setup


Run migrations: php artisan migrate
Seed default roles and admin user: php artisan db:seed --class=AdminUserSeeder
Default admin credentials:

Email: admin@example.com
Password: password

You can update credentials later via admin profile.

Running the Project
Start Laravel development server: php artisan serve

Open in browser:
http://127.0.0.1:8000/login
Login as Admin to access the dashboard.


Created by : Shiva Namdev 
Email Id : shivanamdev581997@gmail.com
