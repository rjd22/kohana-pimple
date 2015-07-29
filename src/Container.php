<?php

namespace Kohana\Pimple;

use Kohana;
use Kohana\Pimple\Provider\ArrayFileProvider;
use Pimple\Container as PimpleContainer;

class Container
{
    /**
     * @var PimpleContainer
     */
    private $container;

    /**
     * @param array $providers
     */
    public function __construct(array $providers)
    {
        $this->container = new PimpleContainer;

        foreach ($providers as $provider) {
            $this->container->register($provider);
        }
    }

    /**
     * @return Container
     */
    public static function factory()
    {
        $dependencyConfigPaths = Kohana::$config->load('pimple.dependencyConfigPaths');

        return new self([
            new ArrayFileProvider($dependencyConfigPaths)
        ]);
    }

    /**
     * @param string $dependency
     * @return object
     */
    public function get($dependency)
    {
        return $this->container[$dependency];
    }

    /**
     * @param string $dependency
     * @return bool
     */
    public function has($dependency)
    {
        return isset($this->container[$dependency]);
    }
}
