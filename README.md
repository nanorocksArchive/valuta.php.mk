# Exchange Rate App

[![MIT Software License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE.md)


#### Exchange rate - CONTENT

* [Setup API](#setup-api)
* [API endpoints](#api-endpoints)
* [PHP unit tests](#php-unit-tests)
* [Docker Devbox](#docker-devbox---api)

## Setup API
- navigate to root dir `cd <project_name>`
- find folder where live composer.json
- go in that folder and run: `composer install`
- next run `composer dump-autoload -o`
- make copy of `.env.example`
- rename `.env.example` to `.env`


## API endpoints
##### GET
- `GET /` - html for api endpoints
- `GET /api/list` - show all exchange rates
- `GET /api/converter/@from/@to/@price` - convert money value from deference value 
- `GET /api/history/@value` - 15 days history for deference money types

## PHP unit tests
We use TDD and PHPUnit as development pattern for building the API.

## Docker Devbox - API

### Build the image:

- navigate to root folder `cd api`

- `docker build -t exchange-rate-api:latest -f docker/Dockerfile .`

### Run the container from image

- `docker run -p 8080:80 -d -v $(pwd):/var/www/exchange-rate-api exchange-rate-api`
