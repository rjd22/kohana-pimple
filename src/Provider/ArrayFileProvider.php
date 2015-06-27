<?php

namespace Kohana\Pimple\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ArrayFileProvider implements ServiceProviderInterface
{
    /**
     * @var array
     */
    private $dependencyConfigPaths;

    /**
     * @param array $dependencyConfigPaths
     */
    public function __construct(array $dependencyConfigPaths)
    {
        $this->dependencyConfigPaths = $dependencyConfigPaths;
    }

    public function register(Container $pimple)
    {
        foreach ($this->dependencyConfigPaths as $dependencyConfigPath) {
            $dependencies = $this->loadDependenciesFromConfig($dependencyConfigPath);

            $this->addDependenciesToContainer($dependencies, $pimple);
        }
    }

    /**
     * @param string $path
     * @return array
     */
    private function loadDependenciesFromConfig($path)
    {
        return include $path;
    }

    /**
     * @param array $dependencies
     * @param Container $pimple
     */
    private function addDependenciesToContainer(array $dependencies, Container $pimple)
    {
        foreach ($dependencies as $tag => $dependency) {
            $pimple[$tag] = $dependency;
        }
    }
}
