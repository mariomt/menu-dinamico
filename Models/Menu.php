<?php

namespace Models;

use Config\Database;
use Core\Model;

class Menu extends Model 
{
    protected static $allowedFields = ['id','name', 'description', 'parent_id'];

    /**
     * Este método devuelve los registros de la tabla menus, agregando el nombre del menú padre.
     *
     * @return array
     */
    public static function getAllWithParentName()
    {
        $pdo = Database::getInstance()->getConnection();
        $valuesWithTableName = array_map(fn($field) => "a.$field", self::$allowedFields);
        $fields = implode(",", array_merge($valuesWithTableName, ['p.name as parent_name']));
        $table = static::getTable();
        $stmt = $pdo->prepare("SELECT {$fields} FROM {$table} a LEFT JOIN {$table} p on a.parent_id = p.id");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
