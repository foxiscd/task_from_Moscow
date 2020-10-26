<?php

namespace Services;

use Exceptions\DbExceptions;

class Db
{
    private $pdo;
    private static $instance;

    private function __construct()
    {

        $dboptions = (require __DIR__ . '/../settings.php')['db'];
        try {
            $this->pdo = new \PDO(
                'mysql:host=' . $dboptions['host'] . ';dbname=' . $dboptions['dbname'],
                $dboptions['user'],
                $dboptions['password']
            );
            $this->pdo->exec('SET NAMES UTF8');
        } catch (\PDOException $e) {
            throw new DbExceptions('Ошибка при подключении к базе данных' . $e->getMessage());
        }

    }

    public function query(string $sql, $params = [], string $className = 'stdClass'): array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result) {
            return null;
        }
        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }


    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getLastInseartId()
    {
        return (int)$this->pdo->lastInsertId();
    }


}