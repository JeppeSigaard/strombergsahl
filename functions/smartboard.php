<?php
add_action( 'admin_menu', 'smabd_add_admin_menu', 45 );
add_action( 'admin_init', 'smabd_settings_init', 45 );


function smabd_add_admin_menu(  ) { 

	add_menu_page( 'SmartBoard', 'SmartBoard', 'manage_options', 'smartboard', 'smartboard_options_page', 'dashicons-welcome-view-site', 40 );
	add_submenu_page( 'smartboard', 'Indstillinger', 'Indstillinger', 'manage_options', 'admin.php?page=smartboard', '');

}


function smabd_settings_exist(  ) { 

	if( false == get_option( 'smartboard_settings' ) ) { 

		add_option( 'smartboard_settings' );

	}

}


function smabd_settings_init(  ) { 

	register_setting( 'pluginPage', 'smabd_settings' );

	add_settings_section(
		'smabd_pluginPage_section', 
		__( '', 'smabd' ), 
		'smabd_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'smabd_text_field_0', 
		__( 'Vis max. (-1 for ubegrænset)', 'smabd' ), 
		'smabd_text_field_0_render', 
		'pluginPage', 
		'smabd_pluginPage_section' 
	);

	add_settings_field( 
		'smabd_checkbox_field_1', 
		__( 'Inkluder ekstra slides', 'smabd' ), 
		'smabd_checkbox_field_1_render', 
		'pluginPage', 
		'smabd_pluginPage_section' 
	);

	add_settings_field( 
		'smabd_checkbox_field_2', 
		__( 'Inkluder projekter', 'smabd' ), 
		'smabd_checkbox_field_2_render', 
		'pluginPage', 
		'smabd_pluginPage_section' 
	);

	add_settings_field( 
		'smabd_text_field_3', 
		__( 'Vis slide i (millisekunder)', 'smabd' ), 
		'smabd_text_field_3_render', 
		'pluginPage', 
		'smabd_pluginPage_section' 
	);

	add_settings_field( 
		'smabd_text_field_4', 
		__( 'Overgang varer i (millisekunder)', 'smabd' ), 
		'smabd_text_field_4_render', 
		'pluginPage', 
		'smabd_pluginPage_section' 
	);

	add_settings_field( 
		'smabd_select_field_6', 
		__( 'Rækkefølge', 'smabd' ), 
		'smabd_select_field_6_render', 
		'pluginPage', 
		'smabd_pluginPage_section' 
	);


}


function smabd_text_field_0_render(  ) { 

	$options = get_option( 'smabd_settings' );
	?>
	<input type='number' name='smabd_settings[smabd_text_field_0]' value='<?php echo $options['smabd_text_field_0']; ?>'>
	<?php

}


function smabd_checkbox_field_1_render(  ) { 

	$options = get_option( 'smabd_settings' );
	?>
	<input type='checkbox' name='smabd_settings[smabd_checkbox_field_1]' <?php checked( $options['smabd_checkbox_field_1'], 1 ); ?> value='1'>
	<?php

}


function smabd_checkbox_field_2_render(  ) { 

	$options = get_option( 'smabd_settings' );
	?>
	<input type='checkbox' name='smabd_settings[smabd_checkbox_field_2]' <?php checked( $options['smabd_checkbox_field_2'], 1 ); ?> value='1'>
	<?php

}


function smabd_text_field_3_render(  ) { 

	$options = get_option( 'smabd_settings' );
	?>
	<input type='number' step="100" name='smabd_settings[smabd_text_field_3]' value='<?php echo $options['smabd_text_field_3']; ?>'>
	<?php

}


function smabd_text_field_4_render(  ) { 

	$options = get_option( 'smabd_settings' );
	?>
	<input type='number' step="100" name='smabd_settings[smabd_text_field_4]' value='<?php echo $options['smabd_text_field_4']; ?>'>
	<?php

}


function smabd_select_field_6_render(  ) { 

	$options = get_option( 'smabd_settings' );
	?>
	<select name='smabd_settings[smabd_select_field_6]'>
		<option value='date' <?php selected( $options['smabd_select_field_6'], 'date' ); ?>>Udgivelsesdato</option>
        <option value='title' <?php selected( $options['smabd_select_field_6'], 'title' ); ?>>Titel</option> 
        <option value='rand' <?php selected( $options['smabd_select_field_6'], 'rand' ); ?>>Tilfældigt</option>
	</select>

<?php

}


function smabd_settings_section_callback(  ) { 

	echo __( 'Indstil visning af slides på <a href=">http://enss.dk/smartboard/">enss.dk/smartboard/</a>. Du kan indstille visning af de enkelte projekter i sidebaren for redigering <a href="http://enss.dk/wp-admin/edit.php?post_type=projekt">her</a> eller oprette særlige ekstra slides <a href="http://enss.dk/wp-admin/edit.php?post_type=smabd">her</a>.', 'smabd' );

}


function smartboard_options_page(  ) { 

	?>
	<form action='options.php' method='post'>
		
		<h2>Indstillinger for SmartBoard</h2>
		
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
		
	</form>
	<?php

}

?>