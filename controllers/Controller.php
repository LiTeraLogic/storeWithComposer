<?php

namespace App\controllers;

use App\services\renderers\IRenderer;
use App\core\App;
use App\services\renderers\TwigRenderer;
use App\services\Request;

/**
 * Class Controller
 * @package App\controllers
 *
 * @property Request request
 */
abstract class Controller
{
    protected $defaultAction = 'all';
    protected $controllerName;
    protected $actionName;
    /**
     * @var TwigRenderer;
     */
    protected $renderer;
    /**
     * @var App
     */
    protected $app;

    // с помощью интерфейса избавляемся от жесткой зависимости
    function __construct(IRenderer $renderer, App $app)
    {
        $this->renderer = $renderer;
        $this->app = $app;
    }

    abstract protected function getDefaultAction(): string;

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    //public function run($actionName = '')
    // запускает нужный action
    public function run($actionName)
    {
        $this->controllerName = $this->app->request->getControllerName();
        $action = $this->getDefaultAction();

        if (!empty($actionName))
        {
            $action = $actionName;
            if (!method_exists($this, $action . 'Action'))
            {
                return $this->render('404');
                //$action = $this->getDefaultAction();
            }
        }
        $action .= 'Action';
        return $this->$action();

    }


    protected function render($template, $params = [])
    {
        return $this->renderer->render($template, $params);
    }

    protected function getMenu()
    {
        $count =$this->app->request->getSession('total')['count'];
        if (empty($count))
        {
            $count = '';
        }
        return [
            [
                'name' => 'Пользователи',
                'href' => '/user/all',
            ],
            [
                'name' => 'Товары',
                'href' => '/good/all',
            ],
            [
                'name' => 'Заказы',
                'href' => '/order/all',
            ],
            [
                'name' => 'Добавить товар',
                'href' => '/good/insert',
            ],
            [
                'name' => 'Добавить пользователя',
                'href' => '/user/insert',
            ],
            [
                'name' => 'Корзина',
                'href' => '/basket',
                'count' => $count,
            ]

        ];
    }

    /**
     * @param $repositoryName
     * @return \App\repositories\Repository|string|null
     */
    protected function getRepository($repositoryName)
    {
        return $this->app->db->getRepository($repositoryName);
    }

    public function rewriteFromSql($good)
    {
        foreach ($good as $key => $property) {
            if (false !== strpos($key, "_")) {
                $arr = explode("_", $key);
                $str = $arr[0];
                for ($i = 1, $iMax = count($arr); $i < $iMax; $i++) {
                    $str .= ucfirst($arr[$i]);
                }
                $methodName = "set" . $str;
                $good->$methodName($property);
                unset($good->$key);
            }
        }

        return $good;
    }
    // получает страницу
    public function getPage()
    {}

    //переход на станицу после действия
    public function toPath($path = '', $msg = '')
    {}
}