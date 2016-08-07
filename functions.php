<?php

// Add the support of thumbnails
add_theme_support('post-thumbnails');


// Enable support for Post Formats.
add_theme_support('post-formats', array(
	'video',
));


add_action('init', 'new_post_formats');


function new_post_formats()
{

	// On crée le type Dossier
	register_post_type(
		'dossier',
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
		'chronique',
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
		'evenement',
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


/*
 * Custom functions
 */


function wpbeginner_numeric_posts_nav()
{

	if (is_singular())
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if ($wp_query->max_num_pages <= 1)
		return;

	$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
	$max = intval($wp_query->max_num_pages);

	/**    Add current page to the array */
	if ($paged >= 1)
		$links[] = $paged;

	/**    Add the pages around the current page to the array */
	if ($paged >= 3) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if (($paged + 2) <= $max) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul>' . "\n";

	/**    Previous Post Link */
	if (get_previous_posts_link())
		printf('<li>%s</li>' . "\n", get_previous_posts_link());

	/**    Link to first page, plus ellipses if necessary */
	if (!in_array(1, $links)) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

		if (!in_array(2, $links))
			echo '<li>…</li>';
	}

	/**    Link to current page, plus 2 pages in either direction if necessary */
	sort($links);
	foreach ((array)$links as $link) {
		$class = $paged == $link ? ' class="active"' : '';
		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
	}

	/**    Link to last page, plus ellipses if necessary */
	if (!in_array($max, $links)) {
		if (!in_array($max - 1, $links))
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
	}

	/**    Next Post Link */
	if (get_next_posts_link())
		printf('<li>%s</li>' . "\n", get_next_posts_link());

	echo '</ul></div>' . "\n";

}