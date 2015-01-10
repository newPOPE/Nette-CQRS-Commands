<?php

namespace AdamStipak\Commands\DI;

use Nette\DI\CompilerExtension;

class CommandsExtension extends CompilerExtension {

  public $defaults = array(
    'commandResolver' => '\AdamStipak\Commands\Command\DefaultCommandResolver',
    'handlerResolver' => '\AdamStipak\Commands\Handler\DefaultHandlerResolver',
    'bus'      => '\AdamStipak\Commands\Bus\DefaultBus',
  );

  public function loadConfiguration() {
    $config = $this->getConfig($this->defaults);

    $builder = $this->getContainerBuilder();

    $builder
      ->addDefinition($this->prefix('handlerResolver'))
      ->setClass(
        $this->defaults['handlerResolver'],
        array('@container')
      );

    $builder
      ->addDefinition($this->prefix('commandResolver'))
      ->setClass(
        $this->defaults['commandResolver'],
        array(
          '@' . $this->prefix('handlerResolver') . '::resolve',
          $config['handlers']
        )
      );

    $builder
      ->addDefinition($this->prefix('bus'))
      ->setClass(
        $this->defaults['bus'],
        array('@' . $this->prefix('commandResolver'))
      );
  }
}
