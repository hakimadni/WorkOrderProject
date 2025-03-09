## 🚀 Work Order Management System Setup Guide

This guide will help you set up the **Work Order Management System** on your local environment. Follow the steps below to get started.

---

## 📋 Prerequisites
- **PHP 8.1+**
- **Composer**
- **MySQL**
- **Node.js & NPM** (for frontend assets)
- **Laravel 10+**

---

## ⚙️ Installation Steps

1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   cd <project-folder>
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   - Copy the `.env.example` file to `.env`
   ```bash
   cp .env.example .env
   ```
   - Update database credentials in the `.env` file:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database_name
     DB_USERNAME=your_database_username
     DB_PASSWORD=your_database_password
     ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Run Migrations and Seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Storage Link**
   ```bash
   php artisan storage:link
   ```

7. **Compile Frontend Assets**
   ```bash
   npm run dev
   ```

8. **Serve the Application**
   ```bash
   php artisan serve
   ```

---

## 🔐 Default Login Credentials

| **Role**            | **Email**                | **Password** |
|:------------------- |:------------------------ |:--------------|
| Admin                | `admin@hakeemu.com`      | `123123123`    |
| Production Manager   | `pm@hakeemu.com`         | `123123123`    |
| Operator 1           | `op1@hakeemu.com`        | `123123123`    |
| Operator 2           | `op2@hakeemu.com`        | `123123123`    |
| Operator 3           | `op3@hakeemu.com`        | `123123123`    |

---

## 🛠️ Troubleshooting
### **1. Update Failure Issue**
If you encounter the error:
```
Missing required parameter for [Route: workorderprogressmaster.update]...
```
➡️ Make sure your route and controller match this format:
```php
<form action="{{ route('workorderprogressmaster.update', $progressMaster->id) }}" method="POST">
```

### **2. Kanban Status Setup**
For grouping Kanban statuses dynamically based on `WorkOrderProgressMaster`, refer to the optimized controller logic and Blade structure shared earlier.

---

## 📞 Support
If you face any issues, feel free to reach out or check the project documentation for additional guidance.

Happy coding! 😊

Pretty much I trained my GPT to assist to everything in this code
