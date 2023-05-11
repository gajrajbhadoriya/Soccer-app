# Soccer-app 
### Made By Gajraj Bhadoriya
The Soccer App is an API-based application. It allows admin to manage teams and players for a soccer league. the app provides functionality for CRUD operations on teams and players.

## Dependencies
- Composer version 2.5.0 to 2.5.5
- php version 8.0x+
- Laravel v10.x+

## Steps to Install
1. Open Cmd in folder you want to install project in.
2. git clone https://github.com/usernam/projectname.git
3. Then cd into folder using below Command
    - cd projectname

## Install All Composer Dependencies
#### Use below command to install all dependencies then wait till all process is complete...
    - composer install or composer update.

## Create a .env file
### Duplicate .env.example as .env file
    - cp .env.example .env
Fill information of your DB username and password & other info if needed...

## Create DataBase
1. Create DataBase by PhpMyadmin (provided by Xampp) or Any Other DB you use...

## DataBase Structure
NOTE: I recommend to import DB structure Using php artisan method but you can use .sql file to import if you want.

### Use below Command and wait till all migrations complete...
    - php artisan migrate
### Use below Command to Link Storage to Public folder
    - php artisan storage:link
### Generate the application Key:
    - php artisan key:generate
### Run database Migrations: 
    - php artisan migrate
### Start development server:
    - php artisan serve





