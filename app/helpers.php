<?php

function wp_get_menu_array($current_menu) {

    $array_menu = wp_get_nav_menu_items($current_menu);
    $menu = array();
    if (is_array($array_menu) || is_object($array_menu)){

        foreach ($array_menu as $m) {
            if (empty($m->menu_item_parent)) {
                $menu['menu' . $m->ID] = array();
                $menu['menu' . $m->ID]['id']             =   $m->ID;
                $menu['menu' . $m->ID]['title']          =   $m->title;
                $menu['menu' . $m->ID]['url']            =   str_replace(get_site_url(),'',$m->url);
                $menu['menu' . $m->ID]['children']       =   array();
                // $menu['menu' . $m->ID]['isElementor']    =   Elementor\Plugin::instance()->db->is_built_with_elementor($m->object_id);
            }
        }
        $submenu = array();
        foreach ($array_menu as $m) {
            if ($m->menu_item_parent) {
                $submenu['menu' . $m->ID] = array();
                $submenu['menu' . $m->ID]['id']          =   $m->ID;
                $submenu['menu' . $m->ID]['title']       =   $m->title;
                $submenu['menu' . $m->ID]['url']         =   str_replace(get_site_url(),'',$m->url);
                // $submenu['menu' . $m->ID]['isElementor'] =   Elementor\Plugin::instance()->db->is_built_with_elementor($m->object_id);
                $menu['menu' . $m->menu_item_parent]['children']['menu' . $m->ID] = $submenu['menu' . $m->ID];
            }

        }
    }

    return $menu;

}

function wp_get_social() {

    $social_fields = array('Facebook', 'Instagram', 'YouTube', 'Twitter', 'TikTok', 'Pinterest', 'Snapchat');
    $social_prefix = "its_social_";

    foreach($social_fields as $value) {
        $field = strtolower($social_prefix . $value);
        $current_value = get_option($field);
        if ($current_value !== '') {
            $social['social'][$value]['media'] = strtolower($value);
            $social['social'][$value]['link'] = $current_value;
        }
    }

    return $social;
}

function get_media_sizes_URL($id) {
    $sizes = array("thumbnail", "medium", "medium_large", "large", "1536×1536", "2048×2048", "2560×2560");
    foreach ($sizes as $v) {
        $size[$v] = wp_get_attachment_image_url( $id, $v );
    }    
    return $size;
}

function get_relative_permalink( $url ) {
    return str_replace( home_url(), "", $url );
}