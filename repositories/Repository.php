<?php

namespace App\repositories;

use App\core\Container;
use App\entities\Entity;
use App\services\DB;

// для получения и работы с сущьностью: наполнение коробки
abstract class Repository
{
    /**
     * @var DB
     */
    protected $db;
    /**
     * @var Container
     */
    protected $container;

    // возвращает название таблицы
    abstract protected function getTableName(): string;

    abstract protected function getEntityName(): string;


    /*
     * Good constructor.
     *  IDB $db
     */
    /**
     * Good constructor.
     * @param DB $db
     */
    // запрашиваем экземпляр класса DB
    /*function __construct()
    {
        $this->db = static::getDB();
    }*/

    public function setContainer(Container $container)
    {
        $this->container = $container;
        $this->setDB();
    }

    // метод обертка возвращающий класс DB
//    protected function getDB(): DB
//    {
//        return DB::getInstance();
//    }

    protected function setDB()
    {
        $this->db = $this->container->db;
    }
    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->db->queryObject($sql, $this->getEntityName(), [':id' => $id]);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        $ret = $this->db->queryObjects($sql, $this->getEntityName());
        return $ret;
    }

    protected function insert(Entity $entity)//сохранение в бд
    {
        $keys = [];
        $sendValues = [];
        //$className = get_class($this);
        $className = $this->getEntityName();
        foreach ($entity as $key => $property) {
            if ($key === 'id') {
                continue;
            }

            $methodName = "set" . ucfirst($key);

            $patterns = '/([a-z])([A-Z])/';
            $replacements = '${1}_${2}';
            $nameColumn = preg_replace($patterns, $replacements, $key);

            $nameColumn = mb_strtolower($nameColumn);
            //if (method_exists($className, $methodName)) {
            $entity->$methodName($property);

            $keys[] = $nameColumn;

            $sendValues[":{$key}"] = $property;

            //}
        }
        $columns = implode(', ', $keys);
        $values = implode(', ', array_keys($sendValues));

        $tableName = $this->getTableName();
        $sql = "INSERT INTO {$tableName} ($columns) VALUES ({$values})";
        //var_dump($sql);

        $result = $this->db->executeInsertId($sql, $sendValues);
        $entity->setId($result);
    }


    protected function update(Entity $entity)//обновление  в бд
    {
        $values = array();
//        $className = get_class($this);
        $className = $this->getEntityName();

        foreach ($entity as $key => $property) {
            if ($property === NULL) {
                continue;
            }
            $methodName = "set" . ucfirst($key);

            $patterns = '/([a-z])([A-Z])/';
            $replacements = '${1}_${2}';
            $nameColumn = preg_replace($patterns, $replacements, $key);
            $nameColumn = mb_strtolower($nameColumn);

            //if (method_exists($className, $methodName)) {
            $entity->$methodName($property);

            $values[] = $nameColumn . '=:' . $key;
            $sendValues[":{$key}"] = $property;
            //}
        }
        $values = implode(', ', $values);

        $tableName = $this->getTableName();
        $sql = "UPDATE {$tableName} SET {$values} WHERE id = :id";
        $this->db->execute($sql, $sendValues);
    }

    public function delete(Entity $entity)//обновление  в бд
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        $this->db->execute($sql, [':id' => $entity->getId()]);
    }

    public function save(Entity $entity)//обновление  в бд
    {
        if (empty($entity->getId())) {
            $this->insert($entity);
            return;
        }
        $this->update($entity);
    }

    //какую страницу загружаем
    public function getModeByPage($page)
    {}

    //возвращает количество страниц
    public function getCountList()
    {}
}