# Soccer-app 
### Made By Gajraj Bhadoriya
The Soccer App is an API-based application. It allows admin to manage teams and players for a soccer league. the app provides functionality for CRUD operations on teams and players.

## Steps to Install
1. Open Cmd in folder you want to install project in..
2. Type below Command and hit enter...
3. git clone https://github.com/usernam/projectname.git
4. Then cd into folder using below Command
    - cd projectname

## Install All Composer Dependencies
1. Use below command to install all dependencies then wait till all process is complete...
    - composer install or composer update.

## Create a .env file
Duplicate .env.example as .env file
Fill information of your DB username and password & other info if needed...

## Create DataBase
1. Create DataBase by PhpMyadmin (provided by Xampp) or Any Other DB you use...

## DataBase Structure
NOTE: I recommend to import DB structure Using php artisan method but you can use .sql file to import if you want.

1. Use below Command and wait till all migrations complete...
    - php artisan migrate
2.Use below Command to Link Storage to Public folder
    - php artisan storage:link
3. Generate the application Key: php artisan key:generate
4.Run database Migrations: php artisan migrate
5.start development server: php artisan serve





