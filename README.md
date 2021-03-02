# STORE-EVERTEC

App that allows making orders using placetoPay

## REQUIREMENTS

- Install the PHP version 7
- Install Composer
- Go to the project path cd /path-to-your-project
- Run the command composer install
- Create the .env file in the project path
- Generate a secret key running the command php artisan key:generate
- Runs the command `php artisan jwt:secret` to generate the jwt secret, after copying and pasting inside the .env file.
- Install the PHP mysql php7.2-mysql
- Modify the connection to the database updating the database.php file
- Run the command php artisan migrate
- Finally run the command php artisan serve.

## API

- Import the postman collection in your local environment to create customers, the json founds in the folder postman in the root from this project.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
