<?php

namespace Kohana\Pimple\Tests;


use Kohana\Pimple\Container;
use Kohana\Pimple\Provider\ArrayFileProvider;
use Mockery;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Container
     */
    private $container;

    public function setUp()
    {
        $provider = new ArrayFileProvider([
            realpath(__DIR__ . '/Resources/testDependencies.php')
        ]);

        $this->container = new Container([$provider]);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenTryingToGetANonExistentDependency()
    {
        $this->setExpectedException('InvalidArgumentException');

        $this->container->get('non-existent-dependency');
    }

    /**
     * @test
     */
    public function shouldReturnDependencyFromContainerWhenYouTryToGetIt()
    {
        $dependency = $this->container->get('dependency');

        $this->assertInstanceOf('stdClass', $dependency);
    }

    /**
     * @test
     */
    public function shouldReturnTrueWhenCheckingForAnExistentDependency()
    {
        $this->assertTrue($this->container->has('dependency'));
    }

    /**
     * @test
     */
    public function shouldReturnFalseWhenCheckingForANonExistentDependency()
    {
        $this->assertFalse($this->container->has('non-existent-dependency'));
    }
}
