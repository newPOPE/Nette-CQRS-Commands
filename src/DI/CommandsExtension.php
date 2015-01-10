<?php

namespace AdamStipak\Commands\DI;


use Nette\DI\CompilerExtension;

class CommandsExtension extends CompilerExtension {

  public $defaults = array(
    'commandResolver' => '\SimpleBus\Command\Handler\LazyLoadingCommandHandlerResolver',
    'commandBus' => '\SimpleBus\Command\Bus\DelegatesToCommandHandlers',
  );

  public function loadConfiguration() {
    $config = $this->getConfig($this->defaults);

    $builder = $this->getContainerBuilder();

    $builder->addDefinition($this->prefix('handlerResolver'))
      ->setClass('\AdamStipak\Commands\HandlerResolver', array('@container'));

    $builder->addDefinition($this->prefix('resolver'))
      ->setClass($this->defaults['commandResolver'], array('@commands.handlerResolver::resolve', $config['handlers']));

    $builder->addDefinition('commandBus')
      ->setClass($this->defaults['commandBus'], array('@commands.resolver'));
  }
}
