<?php

namespace JoshuaReyes\LibrarySystem\Tests\Unit;

use PHPUnit\Framework\TestCase;
use JoshuaReyes\LibrarySystem\Container;

class FacadeTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_load_container_class()
    {
        $this->assertInstanceOf(Container::class, new Container());
    }

    /**
     * @test
     */
    public function it_should_bind_and_get_instance_of_class()
    {
        $container = Container::init();
        $container->bind('kernel.sample', new KernelSample());

        $this->assertInstanceOf(KernelSample::class, $container->resolve('kernel.sample'));
    }

    /**
     * @test
     */
    public function it_should_get_last_instance_of_the_container()
    {
        $container = Container::instance();

        $this->assertInstanceOf(Container::class, $container);
    }
}

class KernelSample {}
