<?php
namespace App\services;

//class DB implements  IDB
use App\core\Container;
use App\repositories\Repository;

// запросы в БД
/**
 * Class DB
 * @package App\services
 */
class DB
{
    protected $connection; // кранит экземпляр класса PDO
    protected $container;
    protected $config = []; // массив параметров для добавления к $connection

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param $repositoryName
     * @return Repository|null
     */
    public function getRepository($repositoryName)
    {
        if (empty($this->container)){
            return null;
        }
        $repositoryName .= 'Repository';
        return $this->container->$repositoryName;
    }

    /**
     * @return \PDO
     */
    protected function getConnection()
    {
            if (empty($this->connection)){
                $this->connection =  new \PDO(
                    $this->getDsn(),
                    $this->config['username'],
                    $this->config['password']
                );
                $this->connection->setAttribute(
                    \PDO::ATTR_DEFAULT_FETCH_MODE,
                    \PDO::FETCH_ASSOC
                );
            }

        return $this->connection;
    }

    // заполняются строки параметров из config для запроса PDO
    private function getDsn()
    {
        return sprintf(
            '%s:host=%s;dbname=%s;charset=%s;port=%s',
                $this->config['driver'],
                $this->config['host'],
                $this->config['dbname'],
                $this->config['charset'],
                $this->config['port']

        );
    }

    //для классов
    protected function query(string $sql, array $params = [])
    {
        $PDOStatement = $this->getConnection()->prepare($sql);
        $PDOStatement->execute($params);
        return $PDOStatement;
    }

//    public function find($sql, $className, array $params = [] )
//    {
//        return  $this->query($sql, $params)->fetchObject($className);
//    }
    public function find($sql, array $params = [] )
    {
        return $this->query($sql, $params)->fetch();
    }

    public function find2($sql, $className, array $params = [] )
    {
        $this->query($sql, $params);
        return $this->connection->lastInsertId();

    }

    //    создать метод безответных запросов
    public function execute($sql, array $params = [])//обновление  в бд
    {
        $this->query($sql, $params);
    }

    public function executeInsertId($sql, array $params = [] )
    {
        $this->query($sql, $params);
        return $this->connection->lastInsertId();

    }

    public function findAll($sql, array $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function queryObject($sql, $class, array $params = [] )
    {
        $PDOStatement = $this->query($sql, $params);
        // FETCH_CLASS + отслеживание изменений, +проще вызывать доп методы
        $PDOStatement->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $PDOStatement->fetch();

    }

    public function queryObjects($sql, $class, array $params = [])
    {
        $PDOStatement = $this->query($sql, $params);
        // устанавливаем, как будут получаться данные
        $PDOStatement->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $PDOStatement->fetchAll();

        // return $this->query($sql, $params)->fetchAll(\PDO::FETCH_CLASS, $className);
    }
    public function exec(string $sql, array $params = [])
    {
        $this->query($sql, $params);
    }

    public function lastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }



}