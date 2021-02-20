# Laravel Package for implementing Ecommerce taxes

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tipoff/taxes.svg?style=flat-square)](https://packagist.org/packages/tipoff/taxes)
![Tests](https://github.com/tipoff/taxes/workflows/Tests/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/tipoff/taxes.svg?style=flat-square)](https://packagist.org/packages/tipoff/taxes)


This is where your description should go.

## Installation

You can install the package via composer:

```bash
composer require tipoff/taxes
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Tipoff\Taxes\TaxesServiceProvider" --tag="taxes-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Tipoff\Taxes\TaxesServiceProvider" --tag="taxes-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Models

We include the following models:

**List of Models**

- Location Tax
- Tax

For each of these models, this package implements an [authorization policy](https://laravel.com/docs/8.x/authorization) that extends the roles and permissions approach of the [tipoff/authorization](https://github.com/tipoff/authorization) package. The policies for each model in this package are registered through the package and do not need to be registered manually.

The models also have [Laravel Nova resources](https://nova.laravel.com/docs/3.0/resources/) in this package and they are also registered through the package and do not need to be registered manually.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Tipoff](https://github.com/tipoff)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
