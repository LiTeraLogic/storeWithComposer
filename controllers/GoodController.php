<?php

namespace App\controllers;

use App\entities\Good;
use App\repositories\GoodRepository;

class GoodController extends Controller
{
    protected $defaultAction = 'all';

    protected function getDefaultAction(): string
    {
        return $this->defaultAction;
    }

    public function oneAction()
    {
        $id = 0;
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
        }
        $good = $this->getRepository('Good')->getOne($id);

        $good = $this->rewriteFromSql($good);
        $nameClass = $this->controllerName;
        return $this->render(
            "{$nameClass}One",
            [
                $nameClass => $good,
                'title' => $good->nameGood,
                'menu' => $this->getMenu(),
            ]);
    }

    /**
     * @return string
     */
    public function allAction()
    {
        $goods = $this->getRepository('Good')->getAll();
        foreach ($goods as $good) {
            $this->rewriteFromSql($good);
        }
        $nameClass = $this->controllerName;
        return $this->render(
            "{$nameClass}All",
            [
                "{$nameClass}s" => $goods,
                'title' => $this->app->getConfig('title'),
                'menu' => $this->getMenu(),
            ]);
    }

    public function insertAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $good = new Good();
            $good->setNameGood($_POST['nameGood']);
            $good->setInfo($_POST['info']);
            $good->setPrice($_POST['price']);

            $this->getRepository('Good')->save($good);
            header('Location: /good/all');
            return '';
            //return 'add';
        }

        return $this->render(
            'goodAdd',
            [
                'menu' => $this->getMenu(),
            ]
        );
    }

    public function delAction()
    {
        $id = 0;
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
        }
//        $nam = $this->app->basketServices->del($id);
//        var_dump($nam);
        $good = new Good();
        $good->setId($id);
        $this->getRepository('Good')->delete($good);
        $this->allAction();
        header('Location: /good/all');
        return '';
        /*$nameClass = $this->controllerName;
        return $this->render(
            "{$nameClass}All",
            [
                "{$nameClass}s" => $goods,
                'title' => $this->app->getConfig('title'),
                'menu' => $this->getMenu(),
            ]);*/
    }

}