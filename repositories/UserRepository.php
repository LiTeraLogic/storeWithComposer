<?php
namespace App\repositories;

use App\entities\User;

class UserRepository extends Repository
{
    protected  function getTableName(): string
    {
        return 'users';
    }

    protected  function getEntityName(): string
    {
        return User::class;
    }
}