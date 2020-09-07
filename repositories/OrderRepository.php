<?php
namespace App\repositories;

use App\entities\Good;
use App\controllers\Controller;
use App\entities\Order;

class OrderRepository extends Repository
{
    protected  function getTableName(): string
    {
        return 'orders';
    }

    protected  function getEntityName(): string
    {
        return Order::class;
    }

}