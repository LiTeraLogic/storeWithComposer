<?php
namespace App\repositories;

use App\entities\Good;
use App\controllers\Controller;

class GoodRepository extends Repository
{
    protected  function getTableName(): string
    {
        return 'goods';
    }

    protected  function getEntityName(): string
    {
        // возврат сущности, которая будет использоваться
        return Good::class;
    }

}