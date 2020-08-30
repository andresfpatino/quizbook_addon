<?php

if(! defined('ABSPATH')) exit; // evita la lectura por url

function quizbook_examen_agregar_metaboxes(){
    add_meta_box('quizbook_examen_meta_box', 'Preguntas Examen', 'quizbook_examen_metaboxes', 'examenes', 'normal', 'high', null );
}
add_action('add_meta_boxes', 'quizbook_examen_agregar_metaboxes');

function quizbook_examen_metaboxes(){ ?>
   

<?php 
}