<?php

use App\Utils;

include_once __DIR__ . '/vendor/autoload.php';

?>
<!doctype html>
<html>
<head <?= language_attributes() ?> >

	<meta charset="<?= bloginfo('charset') ?>">
	<!--[if IE]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->

	<?php
	if (is_single() && have_posts()) {

		the_post();

		echo '<title>' . get_bloginfo('name') . ' | ' . get_the_title() . '</title>';

		rewind_posts();


	} else {

		echo '<title>' . get_bloginfo('name') . '</title>';

	}

	?>

	<meta name="description" content="Description">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<link rel="stylesheet" href="<?= bloginfo('stylesheet_url') ?>" media="all">

	<?= wp_head() ?>

</head>
<body>

<!-- Top bar -->
<div class="topbar">
	<div class="container">

		<nav class="topNav">
			<?= Utils::getWPMenu('top-bar-menu', false, false, 'topNav__item'); ?>
		</nav>

		<?= Utils::getSocials([], 'topSocial', 'topSocial__item'); ?>

		<button class="topSearch" data-js="topSearchButton"><img class="topSearch__icon"
		                                                         src="<?= bloginfo("template_directory") ?>/img/ico-search.svg" alt="Rechercher"/>
		</button>
	</div>
</div>


<!-- Main header -->
<header class="header">
	<div class="container">

		<a class="header__logo" href="<?= bloginfo('url') ?>" title="Accueil">
			<img src="<?= header_image() ?>" alt="Perspectives"/>
		</a>


		<?= Utils::getWPMenu('main-menu', 'catNav', 'catNav__item', 'catNav__link'); ?>

	</div>
</header>


<!-- mobile header -->
<div class="headerMobile">
	<div class="container">
		<a class="headerMobile__logo" href="<?= bloginfo('url') ?>" title="Accueil" rel="nofollow">
			<img src="<?= bloginfo("template_directory") ?>/img/logo-mobile.svg" alt="Logo"/>
		</a>
		<button class="headerMobile__buttonMenu" data-js="mobileMenuButton">Menu</button>
	</div>
</div>

<!-- Mobile menu -->
<div class="mobileOverlay" data-js="mobileOverlay"></div>
<div class="mobileMenu" data-js="mobileMenu">
	<div class="mobileMenu__top">
		<button class="mobileMenu__close" data-js="mobileMenuClose">
			<img src="<?= bloginfo("template_directory") ?>/img/ico-close.svg" alt="X"/>
		</button>
	</div>
	<div class="mobileMenu__content">
		<form class="mobileSearch" action="<?= bloginfo('url') ?>/" method="GET">
			<input class="mobileSearch__input" type="search" placeholder="Rechercher..." value="<?= the_search_query() ?>" name="s"/>
			<button class="mobileSearch__button" role="button" type="submit">
				<img src="<?= bloginfo("template_directory") ?>/img/ico-search.svg" alt="Rechercher"/>
			</button>
		</form>

		<?= Utils::getWPMenu('main-menu', 'mobileCat', '', 'mobileCat__link'); ?>

		<?= Utils::getWPMenu('top-bar-menu', 'mobileNav', 'mobileNav__item', 'mobileNav__link'); ?>

	</div>
	<div class="mobileMenu__footer mobileSocial">

		<?= Utils::getSocials([], false, false, 'mobileSocial__item'); ?>

	</div>
</div>
