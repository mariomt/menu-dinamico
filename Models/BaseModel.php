<?php

namespace Models;

use Config\Database;
use PDO;

abstract class BaseModel
{
    protected $pdo;
    protected $allow_fields;
    protected $table;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        if (isset($this->allow_fields) && is_array($this->allow_fields)) {
            $fields = implode(",", $this->allow_fields);
        } else {
            $fields = "*";
        }
        $stmt = $this->pdo->prepare("SELECT {$fields} FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        if (isset($this->allow_fields) && is_array($this->allow_fields)) {
            $fields = implode(",", $this->allow_fields);
        } else {
            $fields = "*";
        }

        $stmt = $this->pdo->prepare("SELECT {$fields} FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function insert($data)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO {$this->table}($columns) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($id, $data)
    {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }

        $fieldsList = implode(", ", $fields);
        $sql = "UPDATE {$this->table} SET $fieldsList WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
