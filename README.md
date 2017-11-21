# SOEN343

### Run php tests

```shell
$ vendor/bin/phpunit --stderr
```

### Run js linting (after `npm install`)

```shell
$ npm run eslint
```

### Autoformat js

```shell
$ npm run eslint -- --fix
```

### Run php linting (after `composer install`)

```shell
$ vendor/bin/phpcs **/*.php --standard=ruleset.xml
```

### Autoformat php

```shell
$ vendor/bin/phpcbf **/*.php --standard=ruleset.xml
```
