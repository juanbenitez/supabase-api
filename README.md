# A minimal PHP implementation of the [Supabase API]

[![Latest Version on Packagist](https://img.shields.io/packagist/v/juanbenitez/supabase-api.svg?style=flat-square)](https://packagist.org/packages/juanbenitez/supabase-api)
[![Tests](https://github.com/juanbenitez/supabase-api/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/juanbenitez/supabase-api/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/juanbenitez/supabase-api.svg?style=flat-square)](https://packagist.org/packages/juanbenitez/supabase-api)

This is a minimal PHP implementation of the [Supabase API](https://supabase.com/docs/guides/api) wich is supported by [PostgREST](https://postgrest.org/en/stable/index.html). It contains only the methods I needed. I'm open however to PRs that add extra methods to the client.

Here are a few examples on how you can use the package:

## Installation

You can install the package via composer:

```bash
composer require juanbenitez/supabase-api
```

## Usage

```php
$skeleton = new Juanbenitez\SupabaseApi();
echo $skeleton->echoPhrase('Hello, Juanbenitez!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Juan Benitez](https://github.com/juanbenitez)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
