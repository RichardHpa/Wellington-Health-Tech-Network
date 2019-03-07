<?php

class nav_has_children_Walker extends Walker_Nav_Menu {
    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
         $id_field = $this->db_fields['id'];
         if (!empty($children_elements[$element->$id_field])) {
             $current = $element->title;
             $current .= ' <i class="fas fa-caret-down"></i>';
             $element->title = $current;
             $element->url = '#';
             $element->class = 'test';
         }
         Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
     }
}
