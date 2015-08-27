<?php 

add_filter( 'rwmb_meta_boxes', 'projects_boxes' );

function projects_boxes( $meta_boxes )
{
	
	$prefix = 'project_';
	
	
	$meta_boxes[] = array(
		
		'id' => 'images',
		'title' => __( 'Billeder', 'rwmb' ),
		'pages' => array( 'projekt','smabd'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		
		'fields' => array(
			
			
			// Billeder
			array(
				'name'             => __( 'Billeder (max. 3)', 'rwmb' ),
				'id'               => $prefix."img",
				'type'             => 'image_advanced',
				'max_file_uploads' => 3,
			),
			

		)
	);

	$meta_boxes[] = array(
		
		'id' => 'facts',
		'title' => __( 'Faktaboks', 'rwmb' ),
		'desc' => __( 'Faktaboks for projektet. Udfyld de felter der er relevante og lad resten stå tomme', 'rwmb' ),
		'pages' => array( 'projekt'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		
		'fields' => array(
			
			// Bygherre
			array(
				'name'  => __( 'Byherre', 'rwmb' ),
				'id'    => $prefix."f_1",
				'type'  => 'text',
			),
			
			// Arkitekt
			array(
				'name'  => __( 'Arkitekt', 'rwmb' ),
				'id'    => $prefix."f_2",
				'type'  => 'text',
			),
			
			// Totalrådgiver
			array(
				'name'  => __( 'Totalrådgiver', 'rwmb' ),
				'id'    => $prefix."f_2_1",
				'type'  => 'text',
			),
			
			// Ingeniør
			array(
				'name'  => __( 'Ingeniør', 'rwmb' ),
				'id'    => $prefix."f_3",
				'type'  => 'text',
			),
			
			// Byggetid
			array(
				'name'  => __( 'Byggetid', 'rwmb' ),
				'id'    => $prefix."f_4",
				'type'  => 'text',
			),
			
			// Entrepriseform
			array(
				'name'  => __( 'Entrepriseform', 'rwmb' ),
				'id'    => $prefix."f_5",
				'type'  => 'text',
			),
			
			// Byggesum
			array(
				'name'  => __( 'Byggesum', 'rwmb' ),
				'id'    => $prefix."f_6",
				'type'  => 'text',
			),
			
			// Areal
			array(
				'name'  => __( 'Areal', 'rwmb' ),
				'id'    => $prefix."f_7",
				'type'  => 'text',
			),
			
			// Beliggenhed
			array(
				'name'  => __( 'Beliggenhed', 'rwmb' ),
				'id'    => $prefix."f_8",
				'type'  => 'text',
			),
			
			

		)
	);
	
	$meta_boxes[] = array(
		
		'id' => 'description',
		'title' => __( 'Beskrivelse', 'rwmb' ),
		'pages' => array( 'projekt','smabd'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		
		'fields' => array(
			
			// Overskrift
			array(
				'name'  => __( 'Overskrift', 'rwmb' ),
				'id'    => $prefix."heading",
				'type'  => 'text',
			),
			
			// Beskrivelse
			array(
				'name'  => __( 'Brødtekst', 'rwmb' ),
				'id'    => $prefix."description",
				'type'  => 'textarea',
			),
			
			

		)
	);
	
	
	$meta_boxes[] = array(
		
		'id' => 'Projektbeskrivelse',
		'title' => __( 'Projektbeskrivelse', 'rwmb' ),
		'pages' => array( 'projekt'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		
		'fields' => array(
			
			// FILE ADVANCED (WP 3.5+)
			array(
				'name' => __( 'Tilføj projektbeskrivelse', 'rwmb' ),
				'id'   => $prefix."pdf",
				'type' => 'file_advanced',
				'max_file_uploads' => 1,
			),
		
			

		)
	);
	
	
	$meta_boxes[] = array(
		
		'id' => 'info',
		'title' => __( 'Information om medarbejder', 'rwmb' ),
		'pages' => array( 'medarbjeder'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		
		'fields' => array(
			
			
			array(
				'name'             => __( 'Stilling', 'rwmb' ),
				'id'               => 'mb_stilling',
				'type'             => 'text',
			),
			
			array(
				'name'             => __( 'Navn', 'rwmb' ),
				'id'               => 'mb_navn',
				'type'             => 'text',
			),
			
			array(
				'name'             => __( 'Telefon', 'rwmb' ),
				'id'               => 'mb_telefon',
				'type'             => 'text',
			),
			
			array(
				'name'             => __( 'Email', 'rwmb' ),
				'id'               => 'mb_email',
				'type'             => 'email',
			),

		)
	);
	
	
	$meta_boxes[] = array(
		
		'id' => 'medarbejder_media',
		'title' => __( 'Medier', 'rwmb' ),
		'pages' => array( 'medarbjeder'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		
		'fields' => array(
		
		array(
				'name'             => __( 'Billede', 'rwmb' ),
				'id'               => 'mb_image',
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),
			
			array(
				'name'             => __( 'CV', 'rwmb' ),
				'id'               => 'mb_cv',
				'type'             => 'file_advanced',
				'max_file_uploads' => 1,
			)
		
		)
		
	);
	
	
	$meta_boxes[] = array(
		
		'id' => 'smartboard',
		'title' => __( 'Vis på SmartBoard', 'rwmb' ),
		'pages' => array( 'projekt','smabd'),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => true,
		
		'fields' => array(
			
			// FILE ADVANCED (WP 3.5+)
			array(
				'name' => __( 'Vis på smartBoard', 'rwmb' ),
				'id'   => 'show_on_smartboard',
				'type' => 'checkbox',
				'std' => 1,
			),
		
			

		)
	);
    
    
    



    $meta_boxes[] = array(
        'id' => 'ct-form',
        'title' => __( 'Opret en kontaktformular til denne side', 'rwmb' ),
        'pages' => array('page'),
        'context' => 'normal',
        'priority' => 'default',
        'autosave' => true,
        'fields' => array(

            array(
                'name'  => __( 'Aktiver for siden', 'rwmb' ),
                'id'    => "ct-form-active",
                'type' => 'checkbox',
                'std'    => '0',
                ),

            array(
                'name'  => __( 'Følgetekst', 'rwmb' ),
                'id'    => "ct-form-text",
                'type' => 'textarea',
                'placeholder'   => 'Skriv en tekst, der vises inden formularen',
                ),

            array(
                'name'  => __( 'Modtager for bygherrer', 'rwmb' ),
                'id'    => "ct-form-receiver",
                'type' => 'email',
                'desc' => __('Hvis email efterlades tom, anvendes sesa@enss.dk','smamo'),
                'placeholder'   => 'sesa@enss.dk',
                ),
            
            array(
                'name'  => __( 'Modtager for arkitekter', 'rwmb' ),
                'id'    => "ct-form-receiver-2",
                'type' => 'email',
                'desc' => __('Hvis email efterlades tom, anvendes sesa@enss.dk','smamo'),
                'placeholder'   => 'sesa@enss.dk',
                ),
            
            array(
                'name'  => __( 'Modtager for samarbejder', 'rwmb' ),
                'id'    => "ct-form-receiver-3",
                'type' => 'email',
                'desc' => __('Hvis email efterlades tom, anvendes kmh@enss.dk','smamo'),
                'placeholder'   => 'kmh@enss.dk',
                ),
        ),
    );

    $meta_boxes[] = array(
        'id' => 'info',
        'title' => __( 'Information', 'rwmb' ),
        'pages' => array('email'),
        'context' => 'normal',
        'priority' => 'default',
        'autosave' => true,
        'fields' => array(

           

            array(
                'name'  => __( 'Sendt via form på', 'rwmb' ),
                'id'    => "post_id",
                'type' => 'text',
                ),

            array(
                'name'  => __( 'Sendt til', 'rwmb' ),
                'id'    => "email_rec",
                'type' => 'text',
                ),

            array(
                'name'  => __( 'Navn', 'rwmb' ),
                'id'    => "navn",
                'type' => 'text',
                ),

            array(
                'name'  => __( 'Email', 'rwmb' ),
                'id'    => "email",
                'type' => 'text',
                ),

            array(
                'name'  => __( 'Telefon', 'rwmb' ),
                'id'    => "telefon",
                'type' => 'text',
                ),
            
            array(
                'name'  => __( 'Firma', 'rwmb' ),
                'id'    => "company",
                'type' => 'text',
                ),

            array(
                'name'  => __( 'Jeg er:', 'rwmb' ),
                'id'    => "kommentar",
                'type' => 'textarea',
                ),
        ),
    );

    
    
	return $meta_boxes;
}

?>