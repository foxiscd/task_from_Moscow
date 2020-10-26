<?php

namespace models;

use models\users\User;
use Services\Db;
use Services\Vardump;

abstract class ActiveRecordEntity
{
    protected $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function __set($name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    public static function findLimit($limitNumber, $orderBy, $ascDesc)
    {
        $db = Db::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '` ORDER BY ' . "$orderBy " . "$ascDesc" . ' LIMIT ' . $limitNumber, [], static::class);
    }


    public static function findAll(): array
    {
        $db = Db::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '`;', [], static::class);
    }

    abstract protected static function getTableName(): string;

    public static function getById($id): self
    {
        $db = Db::getInstance();
        $entities = $db->query('SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',
            [':id' => $id],
            static::class
        );
//        var_dump($entities);die();

        return $entities ? $entities[0] : null;
    }

    public static function getByAuthorIdCreatedAt($authorId, $ascDesc): array
    {
        $db = Db::getInstance();
        $entities = $db->query('SELECT * FROM `' . static::getTableName() . '`  WHERE author_id=:author_id ORDER BY created_at ' . $ascDesc . ';',
            [':author_id' => $authorId],
            static::class
        );
        return $entities;
    }

    public function save()
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if ($this->id !== null) {
            $this->update($mappedProperties);
        } else {
            $this->insert($mappedProperties);
        }
    }

    private function update($mappedProperties)
    {
        $column2params = [];
        $params2values = [];
        $index = 1;
        foreach ($mappedProperties as $column => $value) {
            $param = ':param' . $index;
            $column2params[] = $column . ' = ' . $param;
            $params2values[$param] = $value;
            $index++;
        }
        $sql = 'UPDATE `' . static::getTableName() . '` SET ' . implode(', ', $column2params) . ' WHERE id= ' . $this->id;
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
    }

    private function insert($mappedProperties)
    {
        $filterProperties = array_filter($mappedProperties);
        $columns = [];
        $params = [];
        $index = 1;
        foreach ($filterProperties as $column => $value) {
            $params[] = ':param' . $index;
            $columns[] = $column;
            $params2values[':param' . $index] = $value;

            $index++;
        }
        $sql = 'INSERT INTO `' . static::getTableName() . '` (' . implode(',', $columns) . ') VALUES (' . implode(',', $params) . ');';

        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
        $this->id = $db->getLastInseartId();
        $this->refresh();
    }

    private function camelCaseToUnderscore($source)
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }

    private function mapPropertiesToDbFormat()
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();
        $propertyName = [];

        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties [$propertyNameAsUnderscore] = $this->$propertyName;
        }
        return $mappedProperties;
    }

    private function refresh()
    {
        $objectFromDb = static::getById($this->id);
        $reflector = new \ReflectionObject($objectFromDb);
        $properties = $reflector->getProperties();

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $propertyName = $property->getName();
            $this->$propertyName = $property->getValue($objectFromDb);
        }
    }

    public function delete()
    {
        $db = Db::getInstance();
        $db->query('DELETE FROM `' . static::getTableName() . '` WHERE id = :id', [':id' => $this->id]);
        $this->id = null;

    }

    public static function findOneByColumn(string $columnName, $value)
    {
        $db = Db::getInstance();
        $result = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value LIMIT 1;',
            [':value' => $value],
            static::class
        );
        if ($result === []) {
            return null;
        }
        return $result[0];
    }

    public static function reduceTextToNumber(array $sourceCodes, $number)
    {
        $arrayForAdmin = [];

        foreach ($sourceCodes as $sourceCode) {
            $text = $sourceCode->getText();
            $textWhidth100 = mb_strimwidth($text, 0, $number, '');
            $sourceCode->setText($textWhidth100);
            $arrayForAdmin [] = $sourceCode;
        }
        return $arrayForAdmin;
    }


}