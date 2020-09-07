<?php
namespace App\core;

use App\services\BasketServices;
use App\services\renderers\TwigRenderer;
use \App\services\Request;
use App\services\DB;

/**
 * Class App
 * @package App\core
 * @property Request request
 * @property DB db
 * @property BasketServices basketServices
 *  */
class App
{
    private $config;
    private $container;

    public function run($config)
    {
        $this->config = $config;
        $this->runController();
    }

    //создается экземпляр класса Container
    public function getContainer()
    {
        if (empty($this->container)){
            $this->container = new Container($this->getConfig('components'));
        }

        return $this->container;
    }

    protected function runController()
    {
        $request = $this->request;
        $controllerName = $request->getControllerName();

        if (empty($controllerName)){
            $controllerName = "good";
        }
        $actionName = $request->getActionName();
        $controllerClass = '\\App\\controllers\\' . ucfirst($controllerName) . 'Controller';

        $renderer = new TwigRenderer();
        if (class_exists($controllerClass)) {
            /**
             * @var \App\controllers\Controller $controller
             */
            $controller = new $controllerClass($renderer, $this);
            $content = $controller->run($actionName);

            echo $content;
        } else{
            echo $renderer->render('404');
        }
    }

    // обращение к элементу класса и получает элементы
    public function __get($name)
    {
        return $this->getContainer()->$name;
    }
    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
    }
    public function __isset($name)
    {
        // TODO: Implement __isset() method.
    }

    public function getConfig($name = '')
    {
        if (empty($name)){
            return $this->config;
        }

        if (empty($this->config[$name])){
            return [];
        }

        return $this->config[$name];
    }
}