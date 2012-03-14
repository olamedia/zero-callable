About
=====
This is a set of basic classes for interaction with callable entities.
Providing common api for functions, methods, closures, callable classes etc.

Callable
===========

```php
<?php

$inc = new callable(function($x = 5){
	return $x + 1;
});

$value = $inc->invoke(); // 6
$value2 = $inc->invokeArgs(4); // 5
```

Factories
=========

```php
<?php
$factory = new constructor(function(){
	return new stdClass();
});

$obj = $factory->getNewInstance(); // stdClass#1
$obj2 = $factory->getNewInstance(); // stdClass#2


$staticFactory = constructor::create(function(){
	return new stdClass();
})->share();

$obj3 = $staticFactory->getNewInstance(); // stdClass#3
$obj4 = $staticFactory->getNewInstance(); // stdClass#3 - the same object

$instance = instance::create($obj4);

$obj5 = $instance->getNewInstance(); // stdClass#4 - clone of $obj4
$obj6 = $instance->getNewInstance(); // stdClass#5 - clone of $obj4

$instance->share();

$obj6 = $instance->getNewInstance(); // stdClass#3 - $obj4
```


LICENSE
=======

MIT


