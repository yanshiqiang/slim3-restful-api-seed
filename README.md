# Slim3 RESTful API Seed

A basic starter structure which can be used to develop RESTful APIs, built with the Slim 3 framework and featuring a integrated command line interface using the Symfony Console Component.

## License

Licensed under MIT. Totally free for private or commercial projects.

## Requirements

* PHP 7.0.24+
* MySQL 5.7.20+
* Composer

## Installation

`composer create-project andrewdyer/slim3-restful-api-seed project_name`

### Configuration
* Activate mod_rewrite, route all traffic to application's /public folder.
* Set up the project environment by updating the .env file in the application's root folder.
* Run all available migrations by executing `php vendor/bin/phinx migrate` in the application's root folder.

## Documentation
### Getting Started

#### Controllers

Controllers are typically stored in the `app/Controller` directory, however they can technically live in any directory or any sub-directory. All controllers should extend the `App\Base\Controller` class. The Base Controller is also stored in the `app/Base` directory, and may be used as a place to put shared controller logic.

`php bin/console generate:resource controller ControllerName`

#### Models

Models are typically stored in the `app/Model` directory. 

`php bin/console generate:resource model ModelName`

#### Presenters

Presenters are typically stored in the `app/Presenter` directory. 

`php bin/console generate:resource presenter PresenterName`

#### Middleware

Middleware are typically stored in the `app/Middleware` directory. 

`php bin/console generate:resource middleware MiddlewareName`

#### Commands

Commands are typically stored in the `app/Command` directory. 

`php bin/console generate:resource command CommandName`