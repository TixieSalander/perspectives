<?php

require_once 'vendor/autoload.php';

function register_menus()
{
	register_nav_menus(
		[
			'top-bar-menu' => 'Top-bar',
			'main-menu'    => 'Général',
			'footer-menu'  => 'Footer',
		]
	);
}

/* Autoriser les fichiers SVG */
function wpc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	
	return $mimes;
}

function add_post_formats()
{
	// Enable support for Post Formats.
	add_theme_support('post-formats', array(
		'aside', 'video', 'audio',
	));
}

function rename_post_formats($translation, $text, $context, $domain) {
	$names = array(
		'Aside' => 'Dossier'
	);
	if ($context == 'Post format') {
		$translation = str_replace(array_keys($names), array_values($names), $text);
	}
	return $translation;
}

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

function add_settings()
{

	$global_config = \App\ConfigFactory::getConfig('global');


	add_settings_section('rs_settings', 'Réseaux Sociaux', function () {
		echo "Ici c'est pour les liens vers les comptes des réseaux sociaux";
	}, 'general');


	foreach ($global_config->socials_display as $key => $social) {

		if($key === 'rss') continue;

		$field_name = 'rs_' . $key;

		add_settings_field($field_name, 'Lien vers ' . $social['img_alt'], function () use ($field_name) {
			echo '<input name="'. $field_name .'" type="text" value="' . get_option($field_name, '') . '" placeholder="Laisser vide pour désactiver" />';
		}, 'general', 'rs_settings');

		register_setting('general', $field_name);

	}

	add_settings_field('rs_rss', 'Lien Rss', function () {
		echo '<input name="rs_rss" type="checkbox" value="' . get_option('rs_rss', 1) . '" ' . (get_option('rs_rss', false) ? 'checked' : '') . ' />';
	}, 'general', 'rs_settings');

	register_setting('general', 'rs_rss');

}


add_action('after_setup_theme', 'add_post_formats', 20);
add_action('init', 'register_menus');
add_action('admin_init', 'add_settings');

add_theme_support('custom-header');
add_theme_support('post-thumbnails');

add_filter('the_content', 'medias_filter');
add_filter('img_caption_shortcode', 'my_img_caption_shortcode', 10, 3);
add_filter('upload_mimes', 'wpc_mime_types');
add_filter('gettext_with_context', 'rename_post_formats', 10, 4);