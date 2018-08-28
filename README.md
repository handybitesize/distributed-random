DistributedRandom
=====================

### Normally distributed random values  for PHP

DistributedRandom allows you generate random values within a range enforcing normal distribution rahter than the uniform distribution rand() et al will give you.

Disclaimer. This may not be real math(s). I use it when generating random objects for testing. For example if I want to generate 2000 users in one of 4 user permission groups, if I randomise the user permission_group_id I can expected roughly 500 users in each. However I usually want the majority of generated users to be in the less permissive groups and only a few "admins" created. This library lets you do that by randomisng with a large skew towards the lower end.

You can see the sort of distributions in the demo script

```bash
php -S localhost:8080 demo/web.php 
```


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
use HandyBiteSize\DistributedRandom\GenerateRandom;

//examples here


$randomise = new GenerateRandom();

//random double between 0 and 1 distributed around 0.5
$rand = $randomise->random();

//Array of 10 randon doubles between 0 and 1 distributed around 0.5
$rand = $randomise->randomArray(10);

//eg
//[0.50398172239527, 0.55248558880547, 0.25614964553752, 0.80148380196869, 0.58439718574973,
// 0.48014020914308, 0.73432188492932, 0.58615275804089, 0.34302056021055, 0.41324347746747]



//random double between 10 and 100 distributed around 10 and rounded to nearest 10
$rand = $randomise->random(10, 100, 10, 10);

// array of 10 as above
$rand = $randomise->randomArray(10, 10, 100, 10, 10);

// eg
// [10, 30, 20, 20, 20, 10, 10, 50, 20, 20]

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