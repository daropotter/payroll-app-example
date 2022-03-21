# Example payroll app

## Requirements

- PHP 8.0 with extensions (see `composer.json`)
- Makefile
- Docker, docker-compose
- Composer, Symfony

## To run

```bash
composer install
php bin/console doctrine:migrations:migrate
make run-db
symfony serve
```

And go to http://localhost:8000

To actually get any data, run `example_data.sql` from `migrations` folder against
`localhost` instance of PostgreSQL. Default port.