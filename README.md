# Router, renewed!

[![Latest Version on Packagist](https://img.shields.io/packagist/v/arashrasoulzadeh/zal.svg?style=flat-square)](https://packagist.org/packages/arashrasoulzadeh/zal)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/arashrasoulzadeh/zal/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/arashrasoulzadeh/zal/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/arashrasoulzadeh/zal/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/arashrasoulzadeh/zal/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/arashrasoulzadeh/zal.svg?style=flat-square)](https://packagist.org/packages/arashrasoulzadeh/zal)

structure of project is a clone from [package-skeleton-laravel](https://github.com/spatie/package-skeleton-laravel)

### getting started 
create a file that extends `arashrasoulzadeh\Zal\Templates\ZalAction` and register it inside `AppServiceProvider.php` like this: 
```php
use arashrasoulzadeh\Zal\Facades\Zal;
...
Zal::RegisterAction(CLASS_NAME::class);
```