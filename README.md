# Laravel Boilerplate Project 🚀✨

![Laravel Logo](https://laravel.com/img/logomark.min.svg)
![https://laravel.com/img/logomark.min.svg](https://preview.keenthemes.com/metronic/react/demo1/media/logos/logo-letter-1.png)

🎉 A **customizable Laravel boilerplate** designed to streamline project setup and development. This boilerplate includes pre-configured features for:  
- 🛡️ Role-based access control  
- 🔑 Dynamic permissions  
- 🧩 Modular code structure  

💡 **Template based on Metronic 8**  
🛠️ Boilerplate features built with ❤️ by **Hakeemu**  


## Key Features

### 1. Role-Based Access Control (RBAC)
- Efficient user-role management with CRUD functionalities.
- Roles can dynamically assign permissions to menus and actions.

### 2. Dynamic Permissions
- Assign create, read, update, and delete (CRUD) permissions per role and menu.
- Permissions are stored in the session for quick access.
- Middleware-based enforcement of permissions across routes.

### 3. Modular and Scalable
- Organized folder structure for models, controllers, and views.
- Supports modular extension for additional features.

### 4. User and Menu Management
- Manage users, assign roles, and handle permissions through a unified interface.
- Menu hierarchy with parent and child menus, supporting nested permissions.

### 5. UI Components
- Dynamic tables for managing roles, users, and permissions with checkboxes for CRUD assignments.
- Prebuilt modals for creating and editing users.

### 6. Middleware for Enhanced Security
- Middleware to check permissions before route access.
- Automatically clears session permissions on logout.

### 7. Enhanced Developer Experience
- Fully commented code for easy understanding and customization.
- Includes helper functions for streamlined role and permission management.

## Setup Instructions

1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   cd <repository-directory>

2. **Install Dependencies**
    ```bash
    composer install
    npm install && npm run dev
3. Setup .env from .env.example

4. **Install Dependencies**
    ```bash
    php artisan migrate --seed

5. **Run Project**
   ```bash
    php artisan serve


## Usage
- Access the dashboard at http://127.0.0.1:8000/dashboard.
- Use the user management section to create users and assign roles.
- Manage permissions dynamically through the role management section.
- Contributing
- Contributions are welcome! Feel free to fork the repository and submit pull requests.

### License
This project is licensed under the MIT License.
