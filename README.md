[![Pingpong](https://raw.githubusercontent.com/Thavarshan/pingpong/main/.github/banner.jpg)](https://github.com/Thavarshan/pingpong)

Pingpong is an easy contact manager web app with an API for thrid-party connections. You can view a demo of the application [here](https://pingpongcontacts.herokuapp.com).

## Installation

Please check the official **Laravel** installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

```bash
git clone https://github.com/Thavarshan/pingpong.git
```

Switch to the repo folder

```bash
cd pingpong
```

Install all the dependencies using composer

```bash
composer install
```

Copy the example env file and make the required configuration changes in the .env file

```bash
cp .env.example .env
```

Generate a new application key

```bash
php artisan key:generate
```

Run the database migrations (**Set the database connection in .env before migrating**)

```bash
php artisan migrate
```

Start the local development server

```bash
php artisan serve
```

You can now access the server at http://localhost:8000

**TL;DR command list**

```bash
git clone https://github.com/Thavarshan/pingpong.git
cd pingpong
composer install
cp .env.example .env
php artisan key:generate
```

**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

```bash
php artisan migrate
php artisan serve
```

## Contributing

Thank you for considering contributing to Pingpong! You can read the contribution guide [here](.github/CONTRIBUTING.md).

## Security Vulnerabilities

Please review [our security policy](https://github.com/Thavarshan/pingpong/security/policy) on how to report security vulnerabilities.

## License

Pingpong is open-sourced software licensed under the [MIT license](LICENSE).

