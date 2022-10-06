# Ecologi SDK

[![Latest Version](http://img.shields.io/packagist/v/astrotomic/ecologi-sdk.svg?label=Release&style=for-the-badge)](https://packagist.org/packages/astrotomic/ecologi-sdk)
[![MIT License](https://img.shields.io/github/license/Astrotomic/ecologi-sdk.svg?label=License&color=blue&style=for-the-badge)](https://github.com/Astrotomic/ecologi-sdk/blob/master/LICENSE)
[![Offset Earth](https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-green?style=for-the-badge)](https://forest.astrotomic.info)
[![Larabelles](https://img.shields.io/badge/Larabelles-%F0%9F%A6%84-lightpink?style=for-the-badge)](https://larabelles.com)

[![Total Downloads](https://img.shields.io/packagist/dt/astrotomic/ecologi-sdk.svg?label=Downloads&style=flat-square)](https://packagist.org/packages/astrotomic/ecologi-sdk)

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
$ecologi->purchasing(test: false)->getCarbonOffset(500, unit: CarbonUnit::KG, idempotency: '1234567890');
```
