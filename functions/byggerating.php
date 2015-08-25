<?php
add_action( 'admin_menu', 'bygge_rating_add_admin_menu' );
add_action( 'admin_init', 'bygge_rating_settings_init' );


function bygge_rating_add_admin_menu(  ) { 

	add_options_page( 'Bygge Rating', 'Bygge Rating', 'manage_options', 'bygge_rating', 'bygge_rating_options_page' );

}


function bygge_rating_settings_init(  ) { 

	register_setting( 'pluginPage_1', 'bygge_rating_settings' );

	add_settings_section(
		'bygge_rating_pluginPage_section', 
		__( 'Tilføj en byggerating', 'bgrating' ), 
		'bygge_rating_settings_section_callback', 
		'pluginPage_1'
	);

	add_settings_field( 
		'bygge_rating_text_field_0', 
		__( 'Tidsfrister', 'bgrating' ), 
		'bygge_rating_text_field_0_render', 
		'pluginPage_1', 
		'bygge_rating_pluginPage_section' 
	);

	add_settings_field( 
		'bygge_rating_text_field_1', 
		__( 'Mangler', 'bgrating' ), 
		'bygge_rating_text_field_1_render', 
		'pluginPage_1', 
		'bygge_rating_pluginPage_section' 
	);

	add_settings_field( 
		'bygge_rating_text_field_2', 
		__( 'Arbejdsulykker', 'bgrating' ), 
		'bygge_rating_text_field_2_render', 
		'pluginPage_1', 
		'bygge_rating_pluginPage_section' 
	);

	add_settings_field( 
		'bygge_rating_text_field_3', 
		__( 'Kundetilfredshed', 'bgrating' ), 
		'bygge_rating_text_field_3_render', 
		'pluginPage_1', 
		'bygge_rating_pluginPage_section' 
	);

	/*add_settings_field( 
		'bygge_rating_text_field_4', 
		__( 'Settings field description', 'bgrating' ), 
		'bygge_rating_text_field_4_render', 
		'pluginPage', 
		'bygge_rating_pluginPage_section' 
	);*/


}


function bygge_rating_text_field_0_render(  ) { 

	$options = get_option( 'bygge_rating_settings' );
	?>
	<input type='text' maxlength="1" name='bygge_rating_settings[bygge_rating_text_field_0]' value='<?php echo $options['bygge_rating_text_field_0']; ?>'>
	<?php

}


function bygge_rating_text_field_1_render(  ) { 

	$options = get_option( 'bygge_rating_settings' );
	?>
	<input type='text' maxlength="1" name='bygge_rating_settings[bygge_rating_text_field_1]' value='<?php echo $options['bygge_rating_text_field_1']; ?>'>
	<?php

}


function bygge_rating_text_field_2_render(  ) { 

	$options = get_option( 'bygge_rating_settings' );
	?>
	<input type='text' maxlength="1" name='bygge_rating_settings[bygge_rating_text_field_2]' value='<?php echo $options['bygge_rating_text_field_2']; ?>'>
	<?php

}


function bygge_rating_text_field_3_render(  ) { 

	$options = get_option( 'bygge_rating_settings' );
	?>
	<input type='text' maxlength="1" name='bygge_rating_settings[bygge_rating_text_field_3]' value='<?php echo $options['bygge_rating_text_field_3']; ?>'>
	<?php

}


function bygge_rating_text_field_4_render(  ) { 

	$options = get_option( 'bygge_rating_settings' );
	?>
	<input type='text' maxlength="1" name='bygge_rating_settings[bygge_rating_text_field_4]' value='<?php echo $options['bygge_rating_text_field_4']; ?>'>
	<?php

}


function bygge_rating_settings_section_callback(  ) { 

	echo __( 'Tilføj en byggerating med bogstaverne a - e', 'bgrating' );

}


function bygge_rating_options_page(  ) { 

	?>
	<form action='options.php' method='post'>
		
		<h2>Bygge Rating</h2>
		
		<?php
		settings_fields( 'pluginPage_1' );
		do_settings_sections( 'pluginPage_1' );
		submit_button();
		?>
		
	</form>
	<?php

}

?>