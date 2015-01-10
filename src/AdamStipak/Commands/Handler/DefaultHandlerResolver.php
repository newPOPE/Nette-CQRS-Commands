<?php

namespace AdamStipak\Commands\Handler;

use Nette\DI\Container;
use Nette\Object;
use SimpleBus\Command\Handler\CommandHandler;

class DefaultHandlerResolver extends Object implements IResolver {

  /**
   * @var Container
   */
  private $container;

  /**
   * @param Container $container
   */
  public function __construct(Container $container) {

    $this->container = $container;
  }

  /**
   * @param string $serviceId
   * @return CommandHandler
   */
  public function resolve($serviceId) {
    $handler = $this->container->getByType(get_class($serviceId));

    return $handler;
  }
}
