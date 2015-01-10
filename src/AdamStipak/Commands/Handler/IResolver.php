<?php

namespace AdamStipak\Commands\Handler;

interface IResolver {

  /**
   * @param string|object $service
   * @return object
   */
  public function resolve($service);
}
