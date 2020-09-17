<?php

if(! defined('ABSPATH')) exit;

/*
* Crea un shortcode, uso: [quizbook_examen id="" preguntas="" orden=""]
*/
function quizbook_examen_shortcode($atts){

    // Leer el ID del shortcode para el examen
    $examen_id = (int) $atts['id'];
    $preguntas = maybe_unserialize( get_post_meta($examen_id, 'quizbook_examen', true) );

    $args = array(
        'post_type' => 'quizes',
        'posts_per_page' => $atts['preguntas'],
        'orderby' => $atts['orden'],
        'post__in' => $preguntas
    );
    $quizbook = new WP_Query($args); ?>

    <form name="quizbook_enviar" id="quizbook_enviar">
        <div class="quizbook" id="quizbook">
            <ul class="quizbook__questions">
            <?php while($quizbook->have_posts()): $quizbook->the_post(); ?>
                <li class="quizbook__question">
                <?php the_title('<h2 class="quizbook__question__title">', '</h2>'); ?>
                <div class="quizbook__question__description"> <?php the_content(); ?> </div>
                <?php
                    $opciones = get_post_meta(get_the_ID() );
                    foreach ($opciones as $llave => $opcion) {
                    $resultado = quizbook_filtrar_preguntas($llave);

                    if($resultado === 0){
                        $numero = explode('_', $llave); ?>
                        <div class="quizbook__question--answer" id="<?php echo get_the_id() . ":" . $numero[2]; ?>">
                        <?php echo $opcion[0]; ?>
                        </div>
                    <?php }
                    }
                    ?>
                </li>
            <?php endwhile; wp_reset_postdata(); ?>
            </ul>
        </div>

        <input type="submit" value="Enviar" id="quizbook_submit">

    <div id="quizbook_resultado"></div>

    </form> <?php
}
add_shortcode( 'quizbook_examen', 'quizbook_examen_shortcode' );
