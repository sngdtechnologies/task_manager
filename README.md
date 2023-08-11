# Task Manager

This project is a task manager based on Laravel.

## Prerequisite

Before you can run this project on your machine, make sure you have the following installed :

- MySQL (Use the latest stable version)
- PHP 8.1 (or higher)
- Composer 2.5.8 (or higher)

## Installation

1. Clone this repository to the desired directory on your machine :

   ```
   git clone https://github.com/votreutilisateur/task-manager.git
   ```

2. Navigate to the project directory :

   ```
   cd task-manager
   ```

3. Install the project dependencies by running the following command :

   ```
   composer install
   ```

4. Copy the sample file '.env.example' and rename it `.env` :

   ```
   cp .env.example .env
   ```

5. Configure the file `.env` with your MySQL database information :

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nombase
   DB_USERNAME=admin
   DB_PASSWORD=aj%dfn$&ldcv21JK
   ```

6. Create the corresponding MySQL database and import the data by running the SQL script provided in the `task_manager.sql` :

   ```
   mysql -u admin -p nombase < task_manager.sql
   ```

7. Generate a unique application key by running the following command :

   ```
   php artisan key:generate
   ```

## Starting the Development Server

After all the previous steps are completed, you can start the development server by running the following command :

```
php artisan serve
```

The server will be available at http://127.0.0.1:8000/.


## Contribute

If you would like to contribute to this project, please follow these steps :

1. Create a branch with a clear description of your feature or bug fix :

   ```
   git checkout -b ma-branche
   ```

2. Make your changes and test them locally.

3. Push your changes to the corresponding branch of this repository :

   ```
   git push origin ma-branche
   ```

4. Submit a Pull Request describing your changes.

## Report problems

If you encounter problems with this project, please open a way out by providing as much detail as possible about the problem you encountered.

## Licence

This project is licensed under MIT. Please consult the file `LICENSE` for more information.
```