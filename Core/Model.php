<?php

namespace Core;

use Config\Database;
use Exception;
use PDO;

abstract class Model
{
    protected static $table;
    protected $attributes = [];
    protected static $allowedFields = [];

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            if (in_array($key, static::$allowedFields)) {
                $this->attributes[$key] = $value;
            }
        }
    }

    public static function all()
    {
        $pdo = Database::getInstance()->getConnection();
        $table = static::getTable();
        $stmt = $pdo->query("SELECT * FROM $table");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => new static($row), $rows);
    }

    public static function find($id)
    {
        $pdo = Database::getInstance()->getConnection();
        $table = static::getTable();
        $stmt = $pdo->prepare("SELECT * FROM $table WHERE id = :id LIMIT 1");

        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? new static($row) : null;
    }


    public function save()
    {
        $pdo = Database::getInstance()->getConnection();
        $table = static::getTable();
        
        if (isset($this->attributes['id'])) {
            $fields = implode(', ', array_map(fn($field) => "$field = :$field", array_keys($this->attributes)));
            $stmt = $pdo->prepare("UPDATE $table SET $fields WHERE id = :id");
        } else {
            $fields = implode(', ', array_keys($this->attributes));
            $placeholders = implode(', ', array_map(fn($field) => ":$field", array_keys($this->attributes)));
            $stmt = $pdo->prepare("INSERT INTO $table ($fields) VALUES ($placeholders)");
        }

        $stmt->execute($this->attributes);

        if (!isset($this->attributes['id'])) {
            $this->attributes['id'] = $pdo->lastInsertId();
        }

    }

    public function delete() {
        if (isset($this->attributes['id'])) {
            $pdo = Database::getInstance()->getConnection();
            $table = static::getTable();
            $stmt = $pdo->prepare("DELETE FROM $table WHERE id = :id");
            $stmt->bindParam(':id', $this->attributes['id'], PDO::PARAM_INT);
            if ($stmt->execute()) {
                return true;
            } 
            throw new Exception("No se pudo eliminar el registro con ID {$this->attributes['id']}");
        }
    }

    public function __get($key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function __set($name, $value)
    {
        if (in_array($name, static::$allowedFields)) {
            $this->attributes[$name] = $value;
        }
    }

    public function __isset($name)
    {
        return isset($this->attributes[$name]);
    }

    private function getPDO() {
        return Database::getInstance()->getConnection();
    }

    public static function getTable()
    {
        return static::$table ?? strtolower((new \ReflectionCLass(static::class))->getShortName()) . 's';
    }
}