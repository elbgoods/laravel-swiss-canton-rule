# Laravel Swiss Canton Validation Rules

[![Latest Version](http://img.shields.io/packagist/v/elbgoods/laravel-swiss-canton-rule.svg?label=Release&style=for-the-badge)](https://packagist.org/packages/elbgoods/laravel-swiss-canton-rule)
[![MIT License](https://img.shields.io/github/license/elbgoods/laravel-swiss-canton-rule.svg?label=License&color=blue&style=for-the-badge)](https://github.com/elbgoods/laravel-swiss-canton-rule/blob/master/LICENSE)
[![Offset Earth](https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-green?style=for-the-badge&cacheSeconds=600)](https://offset.earth/treeware)

[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/elbgoods/laravel-swiss-canton-rule/run-tests?label=tests&style=flat-square)](https://github.com/elbgoods/laravel-swiss-canton-rule/actions?query=workflow%3Arun-tests)
[![Total Downloads](https://img.shields.io/packagist/dt/elbgoods/laravel-swiss-canton-rule.svg?style=flat-square)](https://packagist.org/packages/elbgoods/laravel-swiss-canton-rule)


This package provides multiple validation rules to validate swiss cantons.
It's based on [wnx/php-swiss-cantons](https://github.com/stefanzweifel/php-swiss-cantons).

## Installation

At first you have to add this package to your `composer.json`:

```bash
composer require elbgoods/laravel-swiss-canton-rule
```

After this you can publish the package translation files to adjust the error messages:

```bash
php artisan vendor:publish --provider="Elbgoods\SwissCantonRule\SwissCantonRuleServiceProvider" --tag=lang
```

## Usage

### General

This package provides a basic `SwissCantonRule` which you can use. All more specific rules only extend this rule with a predefined `format`.

```php
use Elbgoods\SwissCantonRule\Rules\SwissCantonRule;

$rule = new SwissCantonRule(SwissCantonRule::FORMAT_ABBREVIATION);
```

By default the rule requires a value - if you want to accept `null` values you can use the `nullable()` method or set the `$required` parameter to `false`.

```php
use Elbgoods\SwissCantonRule\Rules\SwissCantonRule;

$rule = new SwissCantonRule(SwissCantonRule::FORMAT_ABBREVIATION, null, false);
$rule->nullable();
```

### Abbreviation

```php
use Elbgoods\SwissCantonRule\Rules\SwissCantonAbbreviationRule;

$rule = new SwissCantonAbbreviationRule();
```

### Zip-code

```php
use Elbgoods\SwissCantonRule\Rules\SwissCantonZipCodeRule;

$rule = new SwissCantonZipCodeRule();
```

### Name

The name rule has a special property - the `locale`. By default it's `null` so it allows all known canton names in all languages.
But you can set a wanted locale, in this case it will validate using the given locale.

```php
use Elbgoods\SwissCantonRule\Rules\SwissCantonNameRule;

$rule = new SwissCantonNameRule(); // all languages
$rule = new SwissCantonNameRule('de'); // german only
```

Because the package is based on `wnx/php-swiss-cantons` we only support the languages available in this package.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Versioning

This package follows [semantic versioning](https://semver.org/).

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

Please see [SECURITY](SECURITY.md) for details.

## Credits

- [Tom Witkowski](https://github.com/Gummibeer)
- [All Contributors](https://github.com/elbgoods/laravel-swiss-canton-rule/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

## Treeware

You're free to use this package, but if it makes it to your production environment we would highly appreciate you buying or planting the world a tree.

It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising above 1.5C is to [plant trees](https://www.bbc.co.uk/news/science-environment-48870920). If you contribute to my forest you’ll be creating employment for local families and restoring wildlife habitats.

You can buy trees at https://offset.earth/treeware

Read more about Treeware at https://treeware.earth

[![We offset our carbon footprint via Offset Earth](https://toolkit.offset.earth/carbonpositiveworkforce/badge/5e186e68516eb60018c5172b?black=true&landscape=true)](https://offset.earth/treeware)
