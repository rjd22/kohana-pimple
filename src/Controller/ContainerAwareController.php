<?php

namespace Kohana\Pimple\Controller;

use Controller as KohanaController;
use Kohana\Pimple\Container;

class ContainerAwareController extends KohanaController
{
    /**
     * @var Container
     */
    protected $container;

    public function before()
    {
        parent::before();

        $this->container = Container::factory();
    }
}
