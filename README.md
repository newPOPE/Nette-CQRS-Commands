Simple CQRS Commands for [Nette Framework](http://nette.org)
===

This extension provide a simle implementation of CQRS commands.

Installation:
---
The best way to install Nette-CQRS-Commands is using  [Composer](http://getcomposer.org/):

```sh
$ composer require adamstipak/nette-cqrs-commands
```

Usage:
---

```yml
services:
  fooCommandHandler: FooCommandHandler # your service

extensions:
	events: AdamStipak\Commands\DI\CommandsExtension
	
commands:
  handlers:
    foo: @fooCommandHandler
```
