<?php


namespace App;


class Utils
{

	static function getWPMenu($menu_name, $ul_class = '', $li_class = '', $a_class = '')
	{

		$locations = get_nav_menu_locations();

		if (isset($locations[ $menu_name ]) && $locations[ $menu_name ] > 0)
			$menu_id = $locations[ $menu_name ];
		else
			return false;

		$items = wp_get_nav_menu_items($menu_id);

		$html = $ul_class === false ? '' : "<ul class=\"$ul_class\">";

		foreach ($items as $item) {

			$title = $item->title;
			$url = $item->url;

			$html .= $li_class === false ? '' : "<li class=\"$li_class\">";
			$html .= "<a href=\"$url\" class=\"$a_class\">$title</a>";
			$html .= $li_class === false ? '' : "</li>";

		}

		$html .= $ul_class === false ? '' : "</ul>";

		return $html;

	}


	static function getSocials($socials = [], $ul_class = '', $li_class = '', $a_class = '')
	{

		$global_config = ConfigFactory::getConfig('global');
		$socials_refs = $global_config->socials_display;

		if (count($socials) === 0)
			$socials = array_keys($socials_refs);

		$html = $ul_class === false ? '' : "<ul class=\"$ul_class\">";

		foreach ($socials as $social) {

			$link = get_option('rs_' . $social, false);

			if (!$link || !array_key_exists($social, $socials_refs)) continue;

			if ($social === 'rss') {
				$link = get_bloginfo($global_config->rss_type . '_url');
			}

			$social_ref = $socials_refs[ $social ];

			$img_link = get_bloginfo('template_directory') . '/img/' . $social_ref['img_file'];
			$img_alt = $social_ref['img_alt'];
			$link_title = $social_ref['link_title'];

			$html .= $li_class === false ? '' : "<li class=\"$li_class\">";
			$html .= "<a href='$link' class='$a_class' title='$link_title'><img src='$img_link' alt='$img_alt' /></a>";
			$html .= $li_class === false ? '' : "</li>";

		}

		$html .= $ul_class === false ? '' : "</ul>";

		return $html;

	}

}