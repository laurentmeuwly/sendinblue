# Sendinblue

This package is a basic abstraction with Laravel integration for the Sendinblue API.

Some informations to create a middleware could be found here: `https://laravelpackage.com/11-middleware.html#creating-middleware`.

## Installation
```sh
composer require lmeuwly/sendinblue
```

Adding the configuration file and the migration to the project:

```sh
php artisan vendor:publish --provider="LMeuwly\Sendinblue\SendinblueServiceProvider"
```

```sh
php artisan migrate
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Credits

- [Laurent Meuwly](https://git.radiofr.ch/lmeuwly)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

