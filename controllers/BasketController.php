<?php
namespace App\controllers;

use App\entities\Good;
use App\repositories\GoodRepository;
use App\controllers\Controller;

/**
 * Class BasketController
 * @package App\controllers
 *
 * @property Controller controller
 */
class BasketController extends Controller
{
    //TODO: поменять на index
    protected $defaultAction = 'my';

    // передаем товары лежащие в session
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

        $request->redirectApp('Товар добавлен в корзину');
        return '';
    }

    // выбор данных
    //TODO: поменять на indexAction()
    public function myAction()
    {
        $basket = $_SESSION['goods'];
        $nameClass = $this->controllerName;
        return $this->render(
            "{$nameClass}One",
            [
                $nameClass => $basket,
                'title' => 'Корзина',
                'menu' => $this->getMenu(),
                'totalPrice' => $this->app->request->getSession('total')['price']
            ]);
    }

    public function delAction()
    {
        $id = 0;
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
        }
        $hasAdd = $this->app->basketServices->del($this->app->request, $id);
        $basket = $_SESSION['goods'];
        if (!$hasAdd) {
            return $this->render('404');
        }

        $nameClass = $this->controllerName;
        return $this->render(
            "{$nameClass}One",
            [
                $nameClass => $basket,
                'title' => 'Корзина',
                'menu' => $this->getMenu(),
            ]);
    }

    protected function getDefaultAction(): string
    {
        return $this->defaultAction;
    }


}