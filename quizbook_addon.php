<?php
/*
    Plugin Name: Quizbook - Addon
    Plugin URI:
    Description: Versión premiunm del plugin Quizbook. Esta versión te permite crear examenes para tus Quizbook
    Version: 1.0
    Author: Andrés Patiño
    Author URI: mailto:andresfelipepatino5@gmail.com
    License: GPL2
    License URI: https://www.gnu.org/licences/gpl-2.0.html
    Text Domain: quizbook
*/

function quizbook_examen_revisar() {
    // Verificamos que exista una función del plugin principal, si no lanzamos el error
    if(!function_exists('quizbook_post_type')) { 
        add_action('admin_notices', 'quizbook_addon_error_activar');
        deactivate_plugins(plugin_basename(__FILE__));
    }
}
add_action('admin_init', 'quizbook_examen_revisar');


// Mensaje de error
function quizbook_addon_error_activar(){
    $clase = 'notice notice-error';
    $mensaje = "Un error ocurrió, necesitas instalar el Plugin principal 'Quizbook'.";
    printf('<div class=" %1$s "> <p> %2$s Puedes encontrarlo <a target="_blank" href="https://github.com/andresfpatino/quizbook"> Aquí </a> </p> </div>', esc_attr($clase), esc_html($mensaje) );
}