<?php

if(! defined('ABSPATH')) exit; // evita la lectura por url

function quizbook_examen_agregar_metaboxes(){
    add_meta_box('quizbook_examen_meta_box', 'Preguntas Examen', 'quizbook_examen_metaboxes', 'examenes', 'normal', 'high', null );
}
add_action('add_meta_boxes', 'quizbook_examen_agregar_metaboxes');

function quizbook_examen_metaboxes(){ ?>
   
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

						<select data-placeholder="Selecciona las preguntas" class="preguntas_select" multiple tabindex="4">
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