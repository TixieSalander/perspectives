<?php

// Add the support of thumbnails
add_theme_support('post-thumbnails');

function add_post_formats()
{
	// Enable support for Post Formats.
	add_theme_support('post-formats', array(
		'aside', 'video', 'audio',
	));
}

add_action('after_setup_theme', 'add_post_formats', 20);

function new_post_types()
{

	// On crée le type Dossier
	register_post_type(
		'dossier',
		array(
			'label'             => 'Dossiers',
			'labels'            => array(
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
			'public'            => true,
			'capability_type'   => 'post',
			'menu_position'     => 5,
			'show_in_admin_bar' => true,
			'hierarchical'      => true,
			'taxonomies'        => ['category', 'post_tag',],
			'supports'          => array(
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
				'post-formats',
			),
			'has_archive'       => true,
		)
	);

	// On crée le type Chronique
	register_post_type(
		'chronique',
		array(
			'label'             => 'Chroniques',
			'labels'            => array(
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
			'public'            => true,
			'capability_type'   => 'post',
			'menu_position'     => 5,
			'show_in_admin_bar' => true,
			'hierarchical'      => true,
			'taxonomies'        => ['category', 'post_tag'],
			'supports'          => array(
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
				'post-formats',
			),
			'has_archive'       => true,
		)
	);

	// On crée le type Chronique
	register_post_type(
		'evenement',
		array(
			'label'             => 'Évenements',
			'labels'            => array(
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
			'public'            => true,
			'capability_type'   => 'post',
			'menu_position'     => 5,
			'show_in_admin_bar' => true,
			'hierarchical'      => true,
			'taxonomies'        => ['category', 'post_tag'],
			'supports'          => array(
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
				'post-formats',
			),
			'has_archive'       => true,
		)
	);

}

add_action('init', 'new_post_types');

function medias_filter($content)
{

	// gestion des boutons "call to action"
	// <a href="http://eliepse.fr">Call to action</a>
	$content = preg_replace('/^(<p[^>]*><a[^>]*)(>[^>]*<\/a><\/p>)$/mi', '$1 class="callToActionContent"$2', $content);

	// gestion des iframe
	$content = preg_replace('/(<iframe.*<\/iframe>)/i', '<span class="embed-youtube" style="text-align:center; display: block;">$1</span>', $content);

	return $content;
}

function my_img_caption_shortcode($empty, $attr, $content)
{
	$attr = shortcode_atts(array(
		'id'      => '',
		'align'   => 'alignnone',
		'width'   => '',
		'caption' => '',
	), $attr);

	if (1 > (int)$attr['width'] || empty($attr['caption'])) {
		return '';
	}

	if ($attr['id']) {
		$attr['id'] = 'id="' . esc_attr($attr['id']) . '" ';
	}

	return '<div ' . $attr['id']
	. 'class="wp-caption ' . esc_attr($attr['align']) . '" '
	. 'style="max-width: ' . (10 + (int)$attr['width']) . 'px;">'
	. do_shortcode($content)
	. '<p class="wp-caption-text">' . $attr['caption'] . '</p>'
	. '</div>';

}

add_filter('the_content', 'medias_filter');
add_filter('img_caption_shortcode', 'my_img_caption_shortcode', 10, 3);

