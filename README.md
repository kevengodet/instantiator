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

You can also partially apply arguments:
```php
<?php

// ...

$userCreator = (new Instantiator)->partial(
            User::class,
            [
                'emailAddress' => 'john@example.com',
            ]
        );

$user = $userCreator(['password' => 'Tr0ub4dor&3']);
```
