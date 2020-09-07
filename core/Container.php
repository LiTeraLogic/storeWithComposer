<?php
namespace App\core;

// Контейнер, в котором хранятся инициализированные классы
// сохраняем компоненты
class Container
{

    protected $components = [];
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function __get($name)
    {
        //существует ли ключ $name в $this->components
        if (array_key_exists($name, $this->components)) {
            return $this->components[$name];
        }

        if (!array_key_exists($name, $this->config)) {
            return null;
        }

        $className = $this->config[$name]['class'];

        if (!class_exists($className)) {
            return null;
        }

        if (array_key_exists('config', $this->config[$name])) {
            $class = new $className($this->config[$name]['config']);
        } else {
            $class = new $className();
        }

        if (method_exists($class, 'setContainer')) {
            $class->setContainer($this);
        }

        $this->components[$name] = $class;

        return $class;
    }

    public function __set($one, $two)
    {
        // TODO: Implement __set() method.
    }
    public function __isset($name)
    {
        // TODO: Implement __isset() method.
    }
}