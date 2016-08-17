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
	
}