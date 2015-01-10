Simple CQRS Commands for [Nette Framework](http://nette.org)
===

###<cite>&ldquor;Connect Commands with services in Nette.&rdquor;</cite>

This extension provide a simle implementation of CQRS commands.

[![Build Status](https://travis-ci.org/newPOPE/Nette-CQRS-Commands.svg?branch=master)](https://travis-ci.org/newPOPE/Nette-CQRS-Commands)

Installation:
---
The best way to install Nette-CQRS-Commands is using  [Composer](http://getcomposer.org/):

```sh
$ composer require adamstipak/nette-cqrs-commands
```

Usage:
---

Example of **Command**:

```php
use SimpleBus\Command\Command;

class FooCommand implements Command {

  public function __construct(...) {
    // your code
  }

  /**
   * @return string
   */
  public function name() {
    return 'foo'; // identificator of command
  }
}
```

Example of **CommandHandler**:

```php
use SimpleBus\Command\Command;
use SimpleBus\Command\Handler\CommandHandler;

class FooCommandHandler implements CommandHandler {

  /**
   * @param FooCommand $command
   */
  public function handle(Command $command) {
    // $command is instance of FooCommand
  }
}
```
Register all things in `config.neon`.

```yml
services:
  fooCommandHandler: FooCommandHandler # your service

extensions:
  events: AdamStipak\Commands\DI\CommandsExtension
	
commands:
  handlers:
    foo: @fooCommandHandler
```

Example of **Presenter**:

```php
class FooPresenter extends Nette\Application\UI\Presenter {

  /**
   * @var AdamStipak\Commands\Bus\DefaultBus
   * @inject
   */
  public $commands;
  
  public function actionBar() {
  
    // ... your code here ...
    
    $this->commands->handle(new FooCommand(...)); // send the command to command bus (model)
  }

}
```
