DistributedRandom
=====================

### Normally distributed random values  for PHP

DistributedRandom allows you generate random values within a range enforcing normal distribution rahter than the uniform distribution rand() et al will give you.

Disclaimer. I use it when generating random objects for testing. For example if I want to generate 2000 users in one of 4 user permission groups, if I randomise the user permission_group_id I can expected roughly 500 users in each. However I usually want the majority of generated users to be in the less permissive groups and only a few "admins" created. This library lets you do that by randomisng with a large skew towards the lower end.


Setup
-----

 Add the library to your `composer.json` file in your project:

```javascript
{
  "require": {
      "handybitesize/distributed-random": "0.*"
  }
}
```

Use [composer](http://getcomposer.org) to install the library:

```bash
$ php composer.phar install
```

Composer will install DistributedRandom inside your vendor folder. Then you can add the following to your
.php files to use the library with Autoloading.

```php
require_once(__DIR__ . '/vendor/autoload.php');
```

Alternatively, use composer on the command line to require and install DistributedRandom:

```
$ php composer.phar require handybitesize/distributed-random:0.*
```

### Minimum Requirements
 * PHP 5.3

Usage
-----
```php
use DistributedRandom\GenerateRandom;

//examples here
```


Unit Tests
----------

To follow!


```bash
$ cd tests
$ phpunit
```

License
-------

Licensed under the MIT License.