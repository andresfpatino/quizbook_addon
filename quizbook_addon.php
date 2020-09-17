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

if(! defined('ABSPATH')) exit; // evita la lectura por url

// Verificamos que exista una función del plugin principal, si no lanzamos el error
function quizbook_examen_revisar() {    
    if(!function_exists('quizbook_post_type')) { 
        add_action('admin_notices', 'quizbook_addon_error_activar');
        deactivate_plugins(plugin_basename(__FILE__));
    }
}
add_action('admin_init', 'quizbook_examen_revisar');


// Mensaje de error en caso no tener el plugin principal
function quizbook_addon_error_activar(){
    $clase = 'notice notice-error';
    $mensaje = "Un error ocurrió, necesitas instalar el Plugin principal 'Quizbook'.";
    printf('<div class=" %1$s "> <p> %2$s Puedes encontrarlo <a target="_blank" href="https://github.com/andresfpatino/quizbook"> Aquí </a> </p> </div>', esc_attr($clase), esc_html($mensaje) );
}


// Crea el postype de examenes
require_once plugin_dir_path(__FILE__) . 'includes/postypes.php';
register_activation_hook(__FILE__, 'quizbook_examenes_rewrite_flush'); 


// Agrega Roles y Permisos a Quizbook Examen
require_once plugin_dir_path( __FILE__ ) . 'includes/roles.php';
register_activation_hook( __FILE__, 'quizbook_examenes_agregar_capabilities' );
register_deactivation_hook( __FILE__, 'quizbook_examenes_remover_capabilities' );


// Añade los metaboxes a quizbook examen
require_once plugin_dir_path( __FILE__ ) . 'includes/metaboxes.php';

// Añade css y js al plugin
require_once plugin_dir_path( __FILE__ ) . 'includes/scripts.php';

// Añade el shortcode de examentes
require_once plugin_dir_path( __FILE__ ) . 'includes/shortcode.php';

// Muestra el shortcode con ID en la columna del postype
require_once plugin_dir_path( __FILE__ ) . 'includes/columnas.php';