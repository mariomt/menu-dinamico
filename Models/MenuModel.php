<?php

require_once MODELS_PATH . 'BaseModel.php';
class MenuModel extends BaseModel
{
    protected $table = 'menus';
    protected $allow_fields = ["id", "name", "description", "parent_id"];

    /**
     * Este método devuelve los registros de la tabla menus, agregando el nombre del menú padre.
     *
     * @return array
     */
    public function getAllWithParentName()
    {
        $valuesWithTableName = array_map(fn($field) => "a.$field", $this->allow_fields);
        $fields = implode(",", array_merge($valuesWithTableName, ['p.name as parent_name']));
        $stmt = $this->pdo->prepare("SELECT {$fields} FROM {$this->table} a LEFT JOIN {$this->table} p on a.parent_id = p.id");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
