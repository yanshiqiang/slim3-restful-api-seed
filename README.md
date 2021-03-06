# Slim3 RESTful API Seed

A basic starter structure which can be used to develop RESTful APIs, built with the Slim 3 framework and featuring a integrated command line interface using the Symfony Console Component.

## Index

* [License](#license)
* [Requirements](#requirements)
* [Installation](#installation)
    * [Configuration](#configuration)
* [Documentation](#documentation)
    * [Getting Started](#getting-started)
    * [Controllers](#controllers)
        * [Creating a new Controller](#creating-a-new-controller)
    * [Models](#models)
        * [Creating a new Model](#creating-a-new-model)
    * [Presenters](#presenters)
        * [Creating a new Presenter](#creating-a-new-presenter)
    * [Middleware](#middleware)
        * [Creating new Middleware](#creating-new-middleware)
        * [Authentication Middleware](#authentication-middleware)
    * [Commands](#commands)
* [Useful Links](#useful-links)

## License

Licensed under MIT. Totally free for private or commercial projects.

## Requirements

* PHP 7.1.14+
* MySQL 5.7.20+
* Composer

## Installation

`composer create-project andrewdyer/slim3-restful-api-seed project_name`

### Configuration
* Activate mod_rewrite, route all traffic to application's /public directory.
* Set up the project environment by updating the .env file in the application's root directory.
* Run all available migrations by executing `php vendor/bin/phinx migrate` in the application's root directory.

## Documentation
### Getting Started

### Controllers

Controllers are typically stored in the `app/Controller` directory, however they can technically live in any directory or any sub-directory. All controllers should extend the `App\Controller\Controller` class, which is used as a place to put shared controller logic.

#### Creating a new Controller

`php bin/console create:controller <controller_name>`

### Models

This project makes use of Eloquent ORM, a simple ActiveRecord implementation for working with databases. Each database table has a corresponding "Model" which is used to interact with that table. Models allow you to query for data in tables, as well as insert new records into the table. Models are typically stored in the `app/Model` directory, but you are free to place them anywhere that can be auto-loaded. All models are required to extend the `App\Model\Model` class.

#### Creating a new Model

`php bin/console create:model <model_name>`

### Presenters

Presenters are used to generate the view data. They are basically a class that accepts a [model](#models) and wraps it in some specific logic to alter the returned values without having to modify the original object. A presenter should not do any data manipulation, but can contain model calls and any other retrieval or preparation operations needed to generate the view data. Presenters are typically stored in the `app/Presenter` directory, although can be placed anywhere that can be auto-loaded, and are required to extend the `App\Presenter\Presenter` class.

#### Creating a new Presenter

`php bin/console create:presenter <presenter_name>`

### Middleware

Middleware is code that is run before and after your application to manipulate the Request and Response objects as you see fit. Although Middleware can be placed anywhere that can be auto-loaded, it is typically stored in the `app/Middleware` and should extend the `App\Middleware\Middleware` class.

#### Creating new Middleware

`php bin/console create:middleware <middleware_name>`

### Commands

Commands are typically stored in the `app/Command` directory. 

`php bin/console create:command <command_name>`

## Useful Links

* [Slim Framework](https://www.slimframework.com)
* [Illuminate Database](https://github.com/illuminate/database)
* [PHP dotenv](https://github.com/vlucas/phpdotenv)
* [Respect Validation](https://github.com/Respect/Validation)
* [Respect Validation Validators](https://github.com/Respect/Validation/blob/1.1/docs/VALIDATORS.md)
* [Monolog](https://github.com/Seldaek/monolog)
* [Phinx Migrations](https://book.cakephp.org/3.0/en/phinx.html)
* [Config](https://github.com/hassankhan/config)
* [The Console Component](https://symfony.com/doc/current/components/console.html)
* [The VarDumper Component](https://symfony.com/doc/current/components/var_dumper.html)
* [PSR-7 JWT Authentication Middleware](https://github.com/tuupola/slim-jwt-auth)