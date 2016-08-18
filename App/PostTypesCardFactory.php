<?php

namespace App;

class PostTypesCardFactory
{

	private static $_instance;
	private $base_filename_preffix = 'raw_base_';
	private $svg_icon;
	private $have_post = true;


	private function __construct()
	{
		$this->svg_icon = '<svg width="10px" height="11px" viewBox="0 5 10 11" version="1.1" xmlns="http://www.w3.org/2000/svg"
				xmlns:xlink="http://www.w3.org/1999/xlink">
				<path stroke="none" fill="#FFFFFF" fill-rule="evenodd"
				d="M1.43333333,5.83291667 L1.25041667,5 L8.74791667,5 L8.565,5.83291667 L1.43333333,5.83291667 L1.43333333,5.83291667 Z M0,8.33333333 L0.847916667,15 L9.12625,15 L10,8.33333333 L0,8.33333333 L0,8.33333333 Z M9.27291667,7.5 L9.4275,6.66666667 L0.570833333,6.66666667 L0.725416667,7.5 L9.27291667,7.5 L9.27291667,7.5 Z"></path>
				</svg>';

		$this->setBase('standart', $this->fetchBaseContent('standart'));
		$this->setBase('dossier', $this->fetchBaseContent('dossier'));
		$this->setBase('video', $this->fetchBaseContent('video'));
	}


	private function setBase($base_suffix = '', $content = '')
	{
		if (!is_string($base_suffix) && !is_string($content))
			return '';

		$base_name = 'base_' . $base_suffix;

		$this->$base_name = $content;
	}


	private function fetchBaseContent($base_suffix = null)
	{
		if (!is_string($base_suffix))
			return '';

		return include __DIR__ . '/post_types_cards/' . $this->base_filename_preffix . $base_suffix . '.php';
	}


	public static function getInstance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new PostTypesCardFactory();
		}

		return self::$_instance;
	}


	public function printHomeModule($leftSize = 2, $rightSize = 1)
	{

		if (!$this->have_post) {
			return null;
		}

		$html = '';
		$html .= "<div class=\"home-module\">";
		$html .= "<div class=\"home-module__grid-$leftSize-$rightSize home-module__grid-1-m\">";

		if ($leftSize >= $rightSize) {

			$html .= $this->getMainModule();
			$html .= $this->getSideModule();

		} else {

			$html .= $this->getSideModule();
			$html .= $this->getMainModule();

		}

		$html .= "</div>";
		$html .= "</div>";

		echo $html;

	}


	private function getMainModule()
	{
		$content = "";
		$content .= "<div class=\"home-module__mainPart\">";
		$content .= $this->getCard(null, [
			'class_size' => $this->getModuleClass(4),
		]);
		$content .= "<div class=\"home-module__grid-2 home-module__grid-1-s\">";
		$content .= implode('', $this->getCardList([2, 2]));
		$content .= "</div>";
		$content .= "</div>";

		return $content;
	}


	public function getCard($base_suffix = null, $values = [], $context = null)
	{

		if (is_null($context)) {

			if (!$this->have_post || !have_posts()) {
				$this->have_post = false;

				return null;
			}

			the_post();

		} else {

			if (!$this->have_post || !$context->have_posts()) {
				$this->have_post = false;

				return null;
			}

			$context->the_post();

		}

		$categories = [];

		foreach (get_the_category() as $cat) {
			$categories[] = $cat->cat_name;
		}

		$values = array_merge([
			'title'       => get_the_title(),
			'permalink'   => get_the_permalink(),
			'thumbnail'   => get_the_post_thumbnail_url(),
			'format_name' => get_post_format(),
			'categories'  => $categories,
			'excerpt'     => get_the_excerpt(),
		], $values);

		$values['type_icon'] = count($values['categories']) === 0 ? '' : $this->svg_icon;

		$values['categories'] = implode(', ', $values['categories']);

		$format = 'standart';

		if (!empty($values['format_name'])) {
			$format = $values['format_name'];
		}


		if (empty($base_suffix))
			switch (strtolower($format)) {
				case 'aside':
					$base_suffix = 'dossier';
					break;
				case 'video':
					$base_suffix = 'video';
					break;
				default:
					$base_suffix = 'standart';
			}

		$card = $this->getBase($base_suffix);

		$card = preg_replace_callback("/{{the_([a-z_]+)}}/", function ($match) use ($values) {

			if (array_key_exists($match[1], $values))
				return $values[ $match[1] ];
			else
				return '';

		}, $card);

		return $card;

	}


	private function getBase($base_suffix = '')
	{
		if (!is_string($base_suffix))
			return '';

		$base_name = 'base_' . $base_suffix;

		return empty($this->$base_name) ? '' : $this->$base_name;
	}


	private function getModuleClass($cardSize)
	{
		switch ($cardSize) {
			case 'suggestion':
				return 'single-suggestion__item';
				break;
			case 4:
				return 'home-moduleBig';
				break;
			case 3:
				return 'home-moduleHigh';
				break;
			case 2:
				return 'home-moduleMedium';
				break;
			case 1:
				return 'home-moduleSmall';
				break;
			default:
				return null;
		}

	}


	private function getCardList($matrix = [], $context = null)
	{
		$list = [];
		foreach ($matrix as $size) {
			$list[] = $this->getCard(null, [
				'class_size' => $this->getModuleClass($size),
			], $context);
		}

		return $list;
	}


	private function getSideModule()
	{
		$content = "";
		$content .= "<div class=\"home-module__sidePart home-module__sidePart-m home-module__sidePart-s\">";
		$content .= implode('', $this->getCardList([3, 1]));
		$content .= "</div>";

		return $content;
	}


	public function getRelated()
	{
		global $post;

		$html = '';

		$tags = wp_get_post_tags($post->ID);

		if ($tags) {

			$tag_ids = array();

			foreach ($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

			$args = array(
				'tag__in'          => $tag_ids,
				'post__not_in'     => array($post->ID),
				'showposts'        => 3, // nombre d'articles à afficher
				'caller_get_posts' => 1,
				'post_type'        => ['post', 'chronique', 'evenement', 'dossier'],
				p,
			);

			$my_query = new \wp_query($args);

			if (!$my_query->have_posts()) {

				$my_query = new \wp_query([
					'post__not_in' => array($post->ID),
					'showposts'    => 3,
					'post_type'    => ['post', 'chronique', 'evenement', 'dossier'],
				]);

			}

			$html .= '<div class="single-suggestion">';
			$html .= '	<h3 class="single-suggestion__title">Ces articles peuvent aussi vous intéresser</h3>';
			$html .= '	<div class="single-suggestion__list grid-3 grid-2-m grid-1-s">';

			$html .= implode('', $this->getCardList(['suggestion', 'suggestion', 'suggestion',], $my_query));

			$html .= '	</div>';
			$html .= '</div>';

			wp_reset_postdata();

		}

		return $html;

	}

}