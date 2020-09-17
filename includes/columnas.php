<?php

if(! defined('ABSPATH')) exit;


// Agrega una columna en el listados de Postype de examenes con el shortcode correspondiente
function quizbook_examen_columna_nueva($defaults){
    $defaults['shortcode'] = 'Shortcode';
    return $defaults;
}
add_filter('manage_examenes_posts_columns', 'quizbook_examen_columna_nueva'); //manage_NOMBRE-DEL-POSTYPE_posts_columns

// Valor a mostrar en la columna
function quizbook_examen_mostrar_shortcode_columna($columna){
    if($columna === 'shortcode'){
        $examen_id = get_the_ID();
        echo "<span class='wp-ui-highlight' style='font-family: monospace; white-space: pre; padding: 3px 5px; display: inline-block;'>";
        echo "[quizbook_examen preguntas='' orden='' id='$examen_id']";
        echo "</span>";
    }
}
add_action('manage_examenes_posts_custom_column', 'quizbook_examen_mostrar_shortcode_columna', 5, 1); // 5 => prioridad , 1 => cantidad de argumentos en la funcion