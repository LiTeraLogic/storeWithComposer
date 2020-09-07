<?php
namespace App\controllers;

use App\entities\User;
use App\repositories\UserRepository;

class UserController extends Controller
{
    protected $defaultAction = 'all';

    protected function getDefaultAction():string
    {
        return $this->defaultAction;
    }



    public function oneAction()
    {
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
        $users =  $this->getRepository('User')->getAll();
        $nameClass = $this->controllerName;
        return $this->render(
            "{$nameClass}All",
            [
            "{$nameClass}s" => $users,
            'title' =>  $this->app->getConfig('title'),
            'menu' => $this->getMenu(),
        ]);
    }

    public function insertAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            $user->setLogin($_POST['login']);
            $user->setAddress($_POST['address']);
            $user->setTel($_POST['tel']);
            $user->setIsAdmin(0);
            $user->setPassword($_POST['password']);

            $this->getRepository('User')->save($user);
            header('Location: /user/all');
            return '';
        }

        return $this->render(
            'userAdd',
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
        $user = new User();
        $user->setId($id);
        $this->getRepository('User')->delete($user);
        $this->allAction();
        header('Location: /user/all');
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