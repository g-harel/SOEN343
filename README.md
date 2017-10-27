# SOEN343

### Commands

##### Setup

Requirements
- bash shell
- xampp (php/apache/mysql)
- npm/node

```shell
$ cp .env.travis .env
$ mysql -e 'CREATE DATABASE soen343;'
$ composer install
$ composer update
$ php artisan key:generate
```

##### Test

```shell
$ vendor/bin/phpunit
```