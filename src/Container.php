<?php

namespace JoshuaReyes\LibrarySystem;

class Container
{
    private static $class = [];

    private static $instance;

    public static function init()
    {
        self::$instance = new static;
        
        return self::$instance;
    }

    public static function instance()
    {
        return self::$instance;
    }

    public function bind($interface, $concrete)
    {
        self::$class[$interface] = $concrete;
    }

    public function resolve($interface)
    {
        return self::$class[$interface];
    }
}
