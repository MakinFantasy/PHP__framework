<?php
namespace Models;

use Services\Db;

abstract class ActiveRecordEntity
{
    protected $id;

    public function __set($name, $value)
    {
        $nameCamelCase = $this->underscoreToCamelcase($name);
        $this->$nameCamelCase = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public static function getById(int $id): ?self
    {
        $db = Db::getInstance();
        $entities = $db->query('SELECT * FROM `' . static::getTableName() . '` WHERE `id`=:id', [':id' => $id], static::class);
        return $entities ? $entities[0] : null;
    }

    public static function findAll(): array
    {
        $db = Db::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '`', [], static::class);
    }


    
    public static function findAllWhere(string $columnName, int $id): ?array{
        $db = Db::getInstance();
        $sql = 'SELECT * FROM `' . static::getTableName() . '` WHERE `'.$columnName.'` = :id';
        return $db->query($sql, [":id" => $id], static::class);
        
    }


    public function save()
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if ($this->id == null)
            $this->insert($mappedProperties);
        else
            $this->update($mappedProperties);
    }

    public function insert(array $mappedProperties): void
    {
        $column = [];
        $params2values = [];
        $paramNames = [];
        $filterProperties = array_filter($mappedProperties);
        foreach ($filterProperties as $column => $value) {
            $columns[] = '`' . $column . '`';
            $paramName = ':' . $column;
            $paramNames[] = $paramName;
            $params2values[$paramName] = $value;
        }
        $sql ='INSERT INTO `'. static::getTableName() .'` ('.implode(',', $columns).') VALUES ('.implode(',', $paramNames).')';
        var_dump($sql);
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
    }

    public function update(array $mappedProperties): void
    {
        $columns2params = [];
        $params2values = [];
        $index = 1;
        foreach ($mappedProperties as $column => $value) {
            $param = ':param' . $index;
            $columns2params[] = $column . '=' . $param;
            $params2values[$param] = $value;
            $index++;
        }
        $sql = 'UPDATE `' . static::getTableName() . '` SET ' . implode(',', $columns2params) . ' WHERE `id` = ' . $this->id;
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);;
    }

    private function underscoreToCamelcase(string $source)
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    private function camelCaseToUnderscore(string $source)
    {
        return strtolower(preg_replace('/([A-Z])/', '_$1', $source));
    }

    private function mapPropertiesToDbFormat(): array
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();

        $mappedProperties = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyUnderscore = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$propertyUnderscore] = $this->$propertyName;
        }
        return $mappedProperties;
    }

    public function destroy(){
        $sql='DELETE FROM `'. static::getTableName() . '` WHERE id=:id';
        $db = Db::getInstance();
        $db->query($sql, [':id' => $this->id], static::class);
    }

    abstract protected static function getTableName(): string;
}
?>