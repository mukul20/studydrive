# Studydrive v1 API's
Studydrive API's can be used to manage university courses and student registrations.

Read API documentation - [Postman Documentation](https://documenter.getpostman.com/view/665369/UVkqrZy1)
# Quick Installation
### Requirements
Composer, PHP 8.1 or greator

Download or clone the repository.
```sh
git clone https://github.com/mukul20/studydrive.git
```
Switch to the repo folder
```sh
cd studydrive
```
Install all the dependencies using composer
```sh
composer install
```
### Environment variables
Copy `.env.example` file to `.env` file and configure DB credentials.
```sh
cp .env.example .env
```
### Database
Migrating tables.
```sh
php artisan migrate
```
Seed tables.
```sh
php artisan db:seed
```

***
# Consuming API's
We are ready to host our application now.
```sh
php artisan serve
```
The API endpoint can now be accessed at
```sh
http://127.0.0.1:8000/
```
For all API endpoints, refer to [Postman Documentation](https://documenter.getpostman.com/view/665369/UVkqrZy1)

# Code overview
This project uses Repository Design Pattern.

* `.env` - Environment variables can be set in this file.

### Folders
This project uses Repository Design Pattern.
* `app/Models` - Contains all the Eloquent models.
* `app/Http/Controllers/API/v1` - Contains all the API controllers.
* `app/Providers` - Contains repository service provider.
* `app/Interfaces` - Contains repository interfaces.
* `app/Repositories` - Contains eloquent repository implementing their interfaces.
* `app/Transformers` - Contains Transformer class for formating API responses.
* `config` - Contains all the application configuration files.
* `database/factories` - Contains factories for models.
* `database/migrations` - Contains all the database migrations.
* `database/seeds` - Contains the database seeder.
* `routes/api/v1` - Contains all the api routes defined in api.php file.
* `tests` - Contains all the application tests.
* `tests/Feature` - Contains all the API tests.
### Running Test Cases

```sh
php artisan test
```
##### Please note: Testing uses a separate in-memory sqlite DB. While testing, application enables testing environment. Hence, after running test cases, do not forget to reset all caches by using below command.
```sh
php artisan optimize
```