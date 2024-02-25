# NYT Best Sellers List & Filter

This is a simple [Laravel](https://laravel.com/docs/10.x) application created with its built-in
solution [Sail](https://laravel.com/docs/8.x/sail) for running project
using [Docker](https://www.docker.com/)

The application has its necessary configuration in order to run container as well.

## Requirements for building and running the application

- [Composer](https://getcomposer.org/download/)
- [Docker](https://docs.docker.com/get-docker/)

## Application Build and Run

After cloning the repository get into the directory and run:

`./vendor/bin/sail up -d`

## Then finally test the application

Go to [http://localhost](http://localhost) in order to see the application running.

## Unit Testing
Run the command:

`./vendor/bin/sail php artisan test`