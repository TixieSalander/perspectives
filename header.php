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
	<title><?= bloginfo('name') ?></title>
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
			<a class="topNav__item">Archives</a>
			<a class="topNav__item">À propos</a>
		</nav>
		<ul class="topSocial">
			<li class="topSocial__item">
				<a href="" title="Profil Twitter">
					<img src="<?= bloginfo("template_directory") ?>/img/ico-twitter.svg" alt="Twitter"/>
				</a>
			</li>
			<li class="topSocial__item">
				<a href="" title="Chaine Youtube">
					<img src="<?= bloginfo("template_directory") ?>/img/ico-youtube.svg" alt="Youtube"/>
				</a>
			</li>
			<li class="topSocial__item">
				<a href="" title="Profil Instagram">
					<img src="<?= bloginfo("template_directory") ?>/img/ico-instagram.svg" alt="Instagram"/>
				</a>
			</li>
			<li class="topSocial__item">
				<a href="" title="Page Facebook">
					<img src="<?= bloginfo("template_directory") ?>/img/ico-facebook.svg" alt="Facebook"/>
				</a>
			</li>
			<li class="topSocial__item">
				<a href="" title="Flux RSS">
					<img src="<?= bloginfo("template_directory") ?>/img/ico-rss.svg" alt="RSS"/>
				</a>
			</li>
		</ul>
		<button class="topSearch" data-js="topSearchButton"><img class="topSearch__icon"
		                                                         src="<?= bloginfo("template_directory") ?>/img/ico-search.svg" alt="Rechercher"/>
		</button>
	</div>
</div>

<!-- Main header -->
<header class="header">
	<div class="container">
		<a class="header__logo" href="" title="Accueil">
			<img src="<?= bloginfo("template_directory") ?>/img/logo-main.svg" alt="Perspectives"/>
		</a>

		<?= Utils::getWPMenu('main-menu', 'catNav', 'catNav__item', 'catNav__link'); ?>

	</div>
</header>


<!-- mobile header -->
<div class="headerMobile">
	<div class="container">
		<a class="headerMobile__logo" href="" title="Accueil" rel="nofollow">
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
		<form class="mobileSearch">
			<input class="mobileSearch__input" type="search" placeholder="Rechercher..."/>
			<button class="mobileSearch__button" role="button" type="submit">
				<img src="<?= bloginfo("template_directory") ?>/img/ico-search.svg" alt="Rechercher"/>
			</button>
		</form>
		<ul class="mobileCat">
			<li>
				<a class="mobileCat__link" href="">Création</a>
			</li>
			<li>
				<a class="mobileCat__link" href="">Ressource</a>
			</li>
			<li>
				<a class="mobileCat__link" href="">Évènement</a>
			</li>
			<li>
				<a class="mobileCat__link" href="">Chronique</a>
			</li>
			<li>
				<a class="mobileCat__link" href="">Dossier</a>
			</li>
		</ul>
		<ul class="mobileNav">
			<li class="mobileNav__item">
				<a class="mobileNav__link" href="">Archives</a>
			</li>
			<li class="mobileNav__item">
				<a class="mobileNav__link" href="">À propos</a>
			</li>
		</ul>
	</div>
	<div class="mobileMenu__footer mobileSocial">
		<a class="mobileSocial__item" href="" title="Profil Twitter">
			<img src="<?= bloginfo("template_directory") ?>/img/ico-twitter.svg" alt="Twitter"/>
		</a>
		<a class="mobileSocial__item" href="" title="Chaine Youtube">
			<img src="<?= bloginfo("template_directory") ?>/img/ico-youtube.svg" alt="Youtube"/>
		</a>
		<a class="mobileSocial__item" href="" title="Profil Instagram">
			<img src="<?= bloginfo("template_directory") ?>/img/ico-instagram.svg" alt="Instagram"/>
		</a>
		<a class="mobileSocial__item" href="" title="Page Facebook">
			<img src="<?= bloginfo("template_directory") ?>/img/ico-facebook.svg" alt="Facebook"/>
		</a>
		<a class="mobileSocial__item" href="" title="Flux RSS">
			<img src="<?= bloginfo("template_directory") ?>/img/ico-rss.svg" alt="RSS"/>
		</a>
		</li>
		</ul>
	</div>
</div>