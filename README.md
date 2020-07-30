# RKDB

A Laravel package to use for saving and retrieving options from DB. You can save values and retrieve them from database easily and efficiently.

## Install

`composer require robotkudos/rkdb`

Add the service provider to `config/app.php`:

```php
<?php

'providers' => [
    // ...

    RobotKudos\RKDB\RKDBServiceProvider::class
];
```

And that's all!

## Usage

It's fairly easy to use RKDB.

Run migrations with artisan: `php artisan migrate`, and now you can save and retrieve options from database; example:

```php
<?php

use RobotKudos/RKDB/Options;

// save option to db
// $options->set(string $key, string $value, string $group_key, optional string $group_title, optional string $type);
$options = new Options();
// if it already exists on the DB, it will be updated.
$options->set('website_title', 'My Cool Website', 'homepage_options', 'Website Title', 'Home Page Options', 'text');

// then get the option
// $options->get(string $key, optional string $default);
$options->get('website_title', 'Default Website Title');
```
