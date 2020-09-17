<?php

if(! defined('ABSPATH')) exit; // evita la lectura por url

function quizbook_examen_agregar_metaboxes(){
    add_meta_box('quizbook_examen_meta_box', 'Preguntas Examen', 'quizbook_examen_metaboxes', 'examenes', 'normal', 'high', null );
}
add_action('add_meta_boxes', 'quizbook_examen_agregar_metaboxes');

function quizbook_examen_metaboxes(){ 
	
	wp_nonce_field(basename(__FILE__), 'quizbook_examen_nonce');
	
	?>
   
	<table class="form-table">
		<tr>
			<th class="row-title" colspan="2"></th>
			<h2>Selecciona las respuestas para que se incluyan en este examen</h2>
		</tr>
		<tr>
			<th class="row-title"> <label for=""> Selecciona de la lista </label> </th>
			<td>
				<?php 
					$args = array(
						'post_type'	=> 'quizes',
						'posts_per_page' => -1, 
					);

					$preguntas = get_posts($args);

					if($preguntas): ?>

						<select data-placeholder="Selecciona las preguntas" name="quizbook_examen[]" class="preguntas_select" multiple tabindex="4">
							<option value=""></option>
							<?php foreach ($preguntas as $pregunta): ?>
								<option value="<?php echo  $pregunta->ID; ?>"> <?php echo $pregunta->post_title; ?> </option>
							<?php endforeach; ?>
						</select>

					<?php else:

						echo '<p> Comienza por agregar preguntas en Quiz </p>';

					endif;
				?>
			
			
			</td>
		</tr>
   	</table>

<?php 
}


/* Guarda la Info de los Metaboxes */
function quizbook_examen_guardar_metaboxes($post_id, $post, $update) {

    if(!isset($_POST['quizbook_examen_nonce']) || !wp_verify_nonce( $_POST['quizbook_examen_nonce'], basename(__FILE__)  ) ) // verifica el nonce creado arriba
    return $post_id;

    if(!current_user_can('edit_post', $post_id)) // verifica permisos de edicion
    return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
	return $post_id;

	$respuestas = '';
	$arreglo_respuestas = array();

	if(isset($_POST['quizbook_examen'])) {
		$respuestas = $_POST['quizbook_examen'];
		
		foreach ($respuestas as $respuesta): 
			$arreglo_respuestas[] = sanitize_text_field( $respuesta );
		endforeach;
	}

	update_post_meta($post_id, 'quizbook_examen', maybe_serialize( $arreglo_respuestas ) );
}
add_action('save_post', 'quizbook_examen_guardar_metaboxes', 10, 3); // 10 = prioridad 3 = cantidad parametros $post_id, $post, $update 