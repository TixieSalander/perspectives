<?php

// Add the support of thumbnails
add_theme_support('post-thumbnails');


// Enable support for Post Formats.
add_theme_support('post-formats', array(
	'aside', 'video', 'link', 'audio',
));


add_action('init', 'new_post_formats');


function new_post_formats()
{

	// On crée le type Dossier
	register_post_type(
		'Dossier',
		array(
			'label'           => 'Dossiers',
			'labels'          => array(
				'name'               => 'Dossiers',
				'singular_name'      => 'Dossier',
				'all_items'          => 'Tous les dossiers',
				'add_new_item'       => 'Ajouter un dossier',
				'edit_item'          => 'Éditer le dossier',
				'new_item'           => 'Nouveau dossier',
				'view_item'          => 'Voir le dossier',
				'search_items'       => 'Rechercher parmi les dossiers',
				'not_found'          => 'Pas de dossier trouvé',
				'not_found_in_trash' => 'Pas de dossier dans la corbeille',
			),
			'public'          => true,
			'capability_type' => 'post',
			'supports'        => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'trackbacks',
				'custom-fields',
				'comments',
				'revisions',
				'page-attributes',
			),
			'has_archive'     => true,
		)
	);

	// On crée le type Chronique
	register_post_type(
		'Chronique',
		array(
			'label'           => 'Chroniques',
			'labels'          => array(
				'name'               => 'Chroniques',
				'singular_name'      => 'Chronique',
				'all_items'          => 'Toutes les chroniques',
				'add_new_item'       => 'Ajouter une chronique',
				'edit_item'          => 'Éditer la chroniques',
				'new_item'           => 'Nouvelle chronique',
				'view_item'          => 'Voir la chronique',
				'search_items'       => 'Rechercher parmi les chroniques',
				'not_found'          => 'Pas de chronique trouvée',
				'not_found_in_trash' => 'Pas de chronique dans la corbeille',
			),
			'public'          => true,
			'capability_type' => 'post',
			'supports'        => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'trackbacks',
				'custom-fields',
				'comments',
				'revisions',
				'page-attributes',
			),
			'has_archive'     => true,
		)
	);

	// On crée le type Chronique
	register_post_type(
		'Évenement',
		array(
			'label'           => 'Évenements',
			'labels'          => array(
				'name'               => 'Évenements',
				'singular_name'      => 'Évenement',
				'all_items'          => 'Tous les évenements',
				'add_new_item'       => 'Ajouter un évenement',
				'edit_item'          => 'Éditer l\'évenement',
				'new_item'           => 'Nouvel évenement',
				'view_item'          => 'Voir l\'évenement',
				'search_items'       => 'Rechercher parmi les évenements',
				'not_found'          => 'Pas d\'évenement trouvée',
				'not_found_in_trash' => 'Pas d\'évenement dans la corbeille',
			),
			'public'          => true,
			'capability_type' => 'post',
			'supports'        => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'trackbacks',
				'custom-fields',
				'comments',
				'revisions',
				'page-attributes',
			),
			'has_archive'     => true,
		)
	);

}