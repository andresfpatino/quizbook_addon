<?php 

if(! defined('ABSPATH')) exit; // evita la lectura por url

function quizbook_examen_styles($hook) {
    
    global $post;

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'examenes' === $post->post_type ) {     
            wp_enqueue_style('chosen', plugins_url('/assets/css/chosen.min.css', __FILE__));
            wp_enqueue_script('chosenjs', plugins_url('/assets/js/chosen.jquery.min.js', __FILE__), array('jquery'), 1.0, true );
            
            wp_enqueue_script('quizbook_scripts', plugins_url('/assets/js/main.js', __FILE__), array(), 1.0, true );
        }
    }
}   
add_action('admin_enqueue_scripts', 'quizbook_examen_styles', 10, 1);