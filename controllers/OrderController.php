<?php
namespace App\controllers;

use App\entities\Good;
use App\entities\Order;
use App\repositories\GoodRepository;
use App\controllers\Controller;

/**
 * Class BasketController
 * @package App\controllers
 *
 * @property Controller controller
 */
class OrderController extends Controller
{
    protected $defaultAction = 'all';

    public function addAction()
    {
        $request = $this->app->request;
        /**
         * @var GoodRepository $goodRepository
         */
        $goodRepository = $this->getRepository('Good');
        $hasAdd = $this->app->basketServices->add($request, $goodRepository);

        if (!$hasAdd) {
            return $this->render('404');
        }
        //$_SESSION['goods'] = [];
        $request->redirectApp('Заказ сделан');
        return '';

        $id = 0;
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
        }
        $user = $this->getRepository('User')->getOne($id);
        $nameClass = $this->controllerName;
        return $this->render(
            "{$nameClass}One",
            [
                "{$nameClass}" => $user,
                'title' => $user->name,
                'menu' => $this->getMenu(),
            ]);
    }

    public function allAction()
    {
        $orders =  $this->getRepository('Order')->getAll();
        foreach ($orders as $key => $property) {
            $orders[$key] = $this->rewriteFromSql($property);
            }
        $nameClass = $this->controllerName;
        return $this->render(
            "{$nameClass}All",
            [
                "{$nameClass}s" => $orders,
                'title' =>  $this->app->getConfig('title'),
                'menu' => $this->getMenu(),
            ]);
    }

    public function oneAction()
    {
        $id = 0;
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
        }
        $order = $this->getRepository('Order')->getOne($id);

        $order = $this->rewriteFromSql($order);
        $getOrder = $order->getOrderData();
        $getOrderJSON = json_decode($getOrder, true);
        $order->setOrderData($getOrderJSON);
        $nameClass = $this->controllerName;
        return $this->render(
            "{$nameClass}One",
            [
                $nameClass => $order,
                'title' => $order->nameGood,
                'menu' => $this->getMenu(),
            ]);
    }

    public function insertAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order = new Order();
            $order->setUserName($_POST['userName']);
            $order->setAddress($_POST['address']);
            $order->setTel($_POST['tel']);
            $order->setPrice($_GET['price']);
            $order->setStatus(1);
            //$order->setOrderData($_SESSION['goods']);
            $order->setOrderData(json_encode($_SESSION['goods']));

            $this->getRepository('Order')->save($order);
            $_SESSION['goods'] = [];
            $_SESSION['total'] = [];
            header('Location: /basket');
            return '';
        }

        return $this->render(
            'basketOne',
            [
                'menu' => $this->getMenu(),
            ]
        );
    }

    public function updateAction()
    {
        $id = 0;
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order = new Order();
            $order->setId($id);
            if (!empty($_POST['userName']))
            {
                $order->setUserName($_POST['userName']);
            }
            if (!empty($_POST['address']))
            {
                $order->setAddress($_POST['address']);
            }
            if (!empty($_POST['tel']))
            {
                $order->setTel($_POST['tel']);
            }
            if (!empty($_POST['status']))
            {
                $order->setStatus($_POST['status']);
            }
            $this->getRepository('Order')->save($order);
            header("Location: /order/one?id={$id}");
            return '';
        }

        return $this->allAction();
    }

    public function delAction()
    {
        $id = 0;
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
        }
        $order = new Order();
        $order->setId($id);
        $this->getRepository('Order')->delete($order);
        $this->allAction();
        header('Location: /order/all');
        return '';
    }

    protected function getDefaultAction(): string
    {
        return $this->defaultAction;
    }


}