Kdyby/DoctrineCollectionsLazy
======

This package provides an implementation of lazy collection for Doctrine/Collections.

[![Build Status](https://travis-ci.org/Kdyby/DoctrineCollectionsLazy.svg?branch=master)](https://travis-ci.org/Kdyby/DoctrineCollectionsLazy)
[![Downloads this Month](https://img.shields.io/packagist/dm/kdyby/doctrine-collections-lazy.svg)](https://packagist.org/packages/kdyby/doctrine-collections-lazy)
[![Latest stable](https://img.shields.io/packagist/v/kdyby/doctrine-collections-lazy.svg)](https://packagist.org/packages/kdyby/doctrine-collections-lazy)
[![Coverage Status](https://coveralls.io/repos/github/Kdyby/DoctrineCollectionsLazy/badge.svg?branch=master)](https://coveralls.io/github/Kdyby/DoctrineCollectionsLazy?branch=master)

Installation
------------

The best way to install Kdyby/DoctrineCollectionsLazy is using  [Composer](http://getcomposer.org/):

```sh
$ composer require kdyby/doctrine-collections-lazy
```

Usage
-----

```php
$collection =  new LazyCollection(function () {
	return [1 => 2, 3 => 4];
});
```

-----

Homepage [http://www.kdyby.org](http://www.kdyby.org) and repository [http://github.com/Kdyby/DoctrineCollectionsLazy](http://github.com/Kdyby/DoctrineCollectionsLazy).
