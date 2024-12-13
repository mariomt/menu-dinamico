<?php
function renderMenu($menu) {
    $html = '<ul class="navigation-container">';
    foreach ($menu as $item) {
        $html .= '<li><a href="/menu/' . $item['id'] . '">' . htmlspecialchars($item['name']) .((!empty($item['content']))? '<img src="/public/imgs/caret-down-fill.svg"/>':'') . '</a>';
        if (!empty($item['content'])) {
            $html .= renderMenu($item['content']); // Llamada recursiva para los submenús
        }
        $html .= '</li>';
    }
    $html .= '</ul>';
    return $html;
}

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