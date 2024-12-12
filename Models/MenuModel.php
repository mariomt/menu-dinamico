<?php
require_once MODELS_PATH . 'BaseModel.php';
class MenuModel extends BaseModel {
    protected $table = 'menus';
    protected $allow_fields = ["id", "name", "description", "parent_id"];

}