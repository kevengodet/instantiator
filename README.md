# keven/instantiator

Instantiate a class from an array of named parameters.

## Install

```shell
$ composer require keven/instantiator
```

## Usage

```php
<?php

use Keven\Instantiator\Instantiator;

class User
{
    public function __construct(string $emailAddress, string $password, string $userName = null)
    {
        // ...
    }
}

$user = (new Instantiator)->instantiate(
            User::class,
            [
                'emailAddress' => 'john@example.com',
                'password' => 'CorrectHorseBatteryStaple',
            ]
        );
```
