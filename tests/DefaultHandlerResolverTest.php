<?php

namespace AdamStipak\Commands\Handler;

class DefaultHandlerResolverTest extends \PHPUnit_Framework_TestCase {

  public function testResolve() {
    $container = new \Nette\DI\Container();
    $container->addService('foo', new \stdClass());

    $resolver = new \AdamStipak\Commands\Handler\DefaultHandlerResolver($container);

    $this->assertSame(
      $container->getService('foo'),
      $resolver->resolve($container->getService('foo'))
    );
  }
}
