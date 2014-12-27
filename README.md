SimpleBudget
============

A simple personal budget manager.

### Installation

 * download files
 * set up database connection details in 
 ``` 
app/config/database.php
 ```
 * run the developer dark magic stuff
 ```
composer install
 ```,
 ```
 bower install
 ```,
 ```
 compass compile
 ```
 * run migration
 ```
 php artisan:migrate
 ```
 * open the app in browser, register a user, log in and have fun watching your money to leave your pocket...

### Description + explanations

The purpose of this app is simple: I've wanted to use Laravel for a project and I'm sick of playing with Excel to manage my personal finances and generate charts. Yes, there is only 1 user enabled, this is intentional.
