# Ecologi SDK

[![Latest Version](http://img.shields.io/packagist/v/astrotomic/ecologi-sdk.svg?label=Release&style=for-the-badge)](https://packagist.org/packages/astrotomic/ecologi-sdk)
[![MIT License](https://img.shields.io/github/license/Astrotomic/ecologi-sdk.svg?label=License&color=blue&style=for-the-badge)](https://github.com/Astrotomic/ecologi-sdk/blob/master/LICENSE)
[![Offset Earth](https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-green?style=for-the-badge)](https://forest.astrotomic.info)
[![Larabelles](https://img.shields.io/badge/Larabelles-%F0%9F%A6%84-lightpink?style=for-the-badge)](https://larabelles.com)

[![Total Downloads](https://img.shields.io/packagist/dt/astrotomic/ecologi-sdk.svg?label=Downloads&style=flat-square)](https://packagist.org/packages/astrotomic/ecologi-sdk)
[![PHP Version](https://img.shields.io/packagist/dependency-v/astrotomic/ecologi-sdk/php?style=flat-square)](https://packagist.org/packages/astrotomic/ecologi-sdk)

## Installation

```bash
composer require astrotomic/ecologi-sdk
```

## Usage

```php
use Astrotomic\Ecologi\Ecologi;
use Astrotomic\Ecologi\Enums\CarbonUnit;

$ecologi = new Ecologi($token);

// Reporting API
$ecologi->reporting()->getTrees('astrotomic');
$ecologi->reporting()->getCarbonOffset('astrotomic');
$ecologi->reporting()->getImpact('astrotomic');

// Purchasing API
$ecologi->purchasing(test: false)->buyTrees(10, name: 'Gummibeer', idempotency: '1234567890');
$ecologi->purchasing(test: false)->buyCarbonOffset(500, unit: CarbonUnit::KG, idempotency: '1234567890');
```

## Contributing

Please see [CONTRIBUTING](https://github.com/Astrotomic/.github/blob/master/CONTRIBUTING.md) for details. You could also be interested in [CODE OF CONDUCT](https://github.com/Astrotomic/.github/blob/master/CODE_OF_CONDUCT.md).

### Security

If you discover any security related issues, please check [SECURITY](https://github.com/Astrotomic/.github/blob/master/SECURITY.md) for steps to report it.

## Credits

- [Tom Witkowski](https://github.com/Gummibeer)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Treeware

You're free to use this package, but if it makes it to your production environment I would highly appreciate you buying the world a tree.

It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising above 1.5C is to [plant trees](https://www.bbc.co.uk/news/science-environment-48870920). If you contribute to my forest you’ll be creating employment for local families and restoring wildlife habitats.

You can buy trees at [ecologi.com/astrotomic](https://forest.astrotomic.info)

Read more about Treeware at [treeware.earth](https://treeware.earth)
