<?php


/**
 * Funcion que genera el template html del contenido del menú.
 * Cada elemento del arreglo debe tener:
 *  - id
 *  - name
 *  - content (opcional cuando es un submenú)
 * @param array $menu Arreglo que contiene la estructura del menú.
 * @return string Template Html del menú
 */
function renderMenu($menu) {
    $imgURL = getURL('/public/imgs/caret-down-fill.svg');
    $menuURL = getURL('/menu');
    $img = '<img src="' . $imgURL . '"/>';
    $html = '<ul class="navigation-container">';
    foreach ($menu as $item) {
        $html .= '<li><a href="'.$menuURL.'/' . $item['id'] . '">' . htmlspecialchars($item['name']) .((!empty($item['content']))? $img:'') . '</a>';
        if (!empty($item['content'])) {
            $html .= renderMenu($item['content']); // Llamada recursiva para los submenús
        }
        $html .= '</li>';
    }
    $html .= '</ul>';
    return $html;
}



/**
 * Función recursiva que construye el arreglo para generar el menú.
 *
 * @param  array $dbData Arreglo con los datos a mapear para construir el menú
 * @param  int|string $parentId Entero que indica si los datos ingresados dependen de otro menú (recursividad) 
 * @return array Devuelve un arreglo que servirá para contruir el html del menú
 */
function buildMenuHierarchy($dbData, $parentId = NULL) {
    $menu = [];
    foreach ($dbData as $row) {
        if($row['parent_id'] === $parentId) {
            $row['content'] = buildMenuHierarchy($dbData, $row['id']);
            $menu[] = $row;
        }
    }
    return $menu;
}