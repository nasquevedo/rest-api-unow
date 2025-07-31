## Restful API Unow

This project is a RESTful API designed with Symfony to manage, log in, and register employees as a test for Unow. The architectures and patterns used to create this project are DDD, Hexagonal Architecture, and Repository Pattern. Following Domain Driven Design, the application was divided into different paths. Every path represents a module in the app (Admin and User). Every path was divided into different Layers, such as: Application (Use cases, Business Logic), Infrastructure (Communication with the external world), and Domain (Managing the business data).

### endpoints



### requirements
- php8.3
- mysql8.0
- Composer2.8
- Docker28.0.4 

### Setting up:

First, clone the repository

```sh
git clone https://github.com/nasquevedo/rest-api-unow.git
```

Once the repository was cloned, go to the project ```cd rest-api-unow``` 

And create the .env file based on .env.local ```cp .env.local .env```

Install the dependencies with composer

```sh
composer install
```

Run docker-compose to create the image and container

```sh
docker-compose up -d --build
```

Then, create the database

```sh
docker exec symfony php bin/console doctrine:database:create
```

Finally, run the migrations

```sh
docker exec symfony php bin/console doctrine:migrations:migrate
```

Now, it could be testing via Postman, using the next URL and the endpoints mentioned in the description
[HTTP://localhost](HTTP://localhost)

### PHP commands
generate a new migration

```sh
php bin/console doctrine:migrations:generate
```

generate a new entity
```sh
php bin/console make:entity
```

generate a new controller
```sh
php bin/console make:controller NameController
```

## Testing
First, create the database for testing

```sh
docker exec symfony php bin/console doctrine:database:create --env=test
```

It will create a schema called test_test. Then, run the following command to make the migrations

```sh
docker exec symfony php bin/console doctrine:migrations:migrate --env=test
```

Finally, execute the following command to run all tests
```sh
docker exec symfony php bin/phpunit
```

Run a specific test
```sh
docker exec symfony php bin/phpunit tests/<test folder>/<test file>
```
