# cymatic php api
Cymatic client php to verify jwt

## Installation
This project using composer.
```
$ composer require octavio/cymatic-php-api:dev-master
```

## Usage
```php

<?php

  require 'vendor/autoload.php';
  use CymaticApi\Cymatic;

  $settings = [
    "tenant" => [
      "name" => "cymatic",
      "clientId" => "xxxxxx-xxxxxxx-xxxxxxxx-xxxxxxx-xxxxxx",
      "secret"   => "xxxxxx-xxxxxxx-xxxxxxxx-xxxxxxx-xxxxxx",
    ]
  ];

  $cymatic = new Cymatic($settings);

  try {
    $payload = [
      "token" => "eyxcdv ..."
    ];
    $verification = $cymatic->verify($payload);
    var_dump($verification);
  } catch (\Throwable $th) {
    echo $th;
  }

```