# Kohana Pimple Module

[![Build Status](https://travis-ci.org/rjd22/kohana-pimple.svg)](https://travis-ci.org/rjd22/kohana-pimple)

Pimple dependency injection container for the Kohana framework.

## Installation

To use this module simply require this module with composer:

```
composer require rjd22/kohana-pimple:"~1.0"
```

Then add the module to the kohana modules list in your `application/bootstrap.php`. Make sure you have a MODPATH or a
vendor path that points to the composer vendor folder.

## Configuration

You have register dependency config files with the pimple container. These config files are similar to the config files
that kohana uses but it's required to register the full path in the `config/pimple.php`.

A sample of a dependency config file:

```php
return [
    'dependency.one' => function ($c) {
        return new Dependency\One;
    },
    'dependency.two' => function ($c) {
        return new Dependency\Two($c['dependency.one']);
    },
];
```


## Usage

You can use this dependency injection container by extending the your controllers with the `Kohana\Pimple\Controller\ContainerAwareController`
this will enable you to access the container by calling the following to check if a dependency exists:

```php
$this->container->has('dependency.one');
```
And the following to get the dependency:
 
```php
$this->container->get('dependency.one');
```

If you don't like extending the controller you can also build the container yourself by calling:

`$container = Container::factory();`
