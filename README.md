## About Login Temperatures App

This is a small webapp that will store the current temperature of two cities when a user logs in, and display a historical list of the users login temperatures.

## Used Technologies

-   Backend API - Laravel 8
-   Front-end - Vue.js
-   MySQL
-   Open Weather API

## Overview

This app build as a single page application (SPA). Because of this is a simple SPA, I used Laravel Sanctum for API Token Authentication. Sanctum is one of most popular official packages of Laravel. Laravel Sanctum provides a simple authentication system for SPAs (single page applications) and simple token-based APIs.I tried to follow Laravel service pattern for this project. Because this app based on a single API service proecess, In this app I used Open Weather API to fetch current temperature data and sync with our database. To do this process I created this re-usable service class. This service class can use to do the data sync process anywhere in app by simply dependency inject it into controller methods. Using this technique, we can move MVC pattern to another layer by extending logic to service class. It I’ll help to improve readability, reusability and keep clean our controllers. For API calls I used Laravel default HTTP Client support library. I created common helper function for API calls. Using this function, we can simply get API responses by passing URL and return type(json,body,etc) as parameters . In database structure I used three tables for Users, Cities and weather data. I used Laravel eloquent ORM for interact with my database. For primary and foreign key mappings, I used eloquent relationships to map and retrieve data from data base. When retrieving data, I used eager loading method to load relationships for efficiency and to avoid popular N+ problem in Laravel.

## set up instructions

-   clone project using github
-   create ‘.env’ file and copy & pase all data inside config_files/env data.txt to .env file
-   run ‘composer update’ command
-   run ‘composer update’ command
-   run ‘composer dump-autoload’ command
-   run ‘php artisan migrate’ command
-   run ‘npm install && npm run dev’ command

## data base set up instructions

create new database in local machine and set DB data in .env file

-   If you like to use fresh db,

    -   run ‘php artisan migrate’ command and register as a new user

-   otherwise import DB file in config_files folder and use below credentials to login
    -   email - test@gmail.com
    -   password - 1234

## try run these commands if you run into any issues while setting up this project

-   composer update --no-scripts
-   npm update vue-loader
