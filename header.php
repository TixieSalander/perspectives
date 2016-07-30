<!doctype html>
<html>
<head <?= language_attributes() ?>

<meta charset="<?= the_title() ?>">
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

<!-- Main header -->
<header class="header">
	<div class="container">
		<a class="header__logo" href="" title="Accueil">
			<img src="img/logo-main.svg" alt="Perspectives"/>
		</a>
		<nav class="catNav">
			<ul>
				<li class="catNav__item">
					<a class="catNav__link" href="" title="">Création</a>
				</li>
				<li class="catNav__item">
					<a class="catNav__link" href="" title="">Ressource</a>
				</li>
				<li class="catNav__item">
					<a class="catNav__link" href="" title="">Évènement</a>
				</li>
				<li class="catNav__item">
					<a class="catNav__link" href="" title="">Chronique</a>
				</li>
				<li class="catNav__item">
					<a class="catNav__link" href="" title="">Dossier</a>
				</li>
			</ul>
		</nav>
	</div>
</header>


<!-- mobile header -->
<div class="headerMobile">
	<div class="container">
		<a class="headerMobile__logo" href="" title="Accueil" rel="nofollow">
			<img src="/img/logo-mobile.svg" alt="Logo"/>
		</a>
		<button class="headerMobile__buttonMenu" data-js="mobileMenuButton">Menu</button>
	</div>
</div>
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
					<img src="img/ico-twitter.svg" alt="Twitter"/>
				</a>
			</li>
			<li class="topSocial__item">
				<a href="" title="Chaine Youtube">
					<img src="img/ico-youtube.svg" alt="Youtube"/>
				</a>
			</li>
			<li class="topSocial__item">
				<a href="" title="Profil Instagram">
					<img src="img/ico-instagram.svg" alt="Instagram"/>
				</a>
			</li>
			<li class="topSocial__item">
				<a href="" title="Page Facebook">
					<img src="img/ico-facebook.svg" alt="Facebook"/>
				</a>
			</li>
			<li class="topSocial__item">
				<a href="" title="Flux RSS">
					<img src="img/ico-rss.svg" alt="RSS"/>
				</a>
			</li>
		</ul>
		<button class="topSearch" data-js="topSearchButton"><img class="topSearch__icon" src="img/ico-search.svg" alt="Rechercher"/></button>
	</div>
</div>


<!-- Mobile menu -->
<div class="mobileOverlay" data-js="mobileOverlay"></div>
<div class="mobileMenu" data-js="mobileMenu">
	<div class="mobileMenu__top">
		<button class="mobileMenu__close" data-js="mobileMenuClose">
			<img src="/img/ico-close.svg" alt="X"/>
		</button>
	</div>
	<div class="mobileMenu__content">
		<form class="mobileSearch">
			<input class="mobileSearch__input" type="search" placeholder="Rechercher..."/>
			<button class="mobileSearch__button" role="button" type="submit">
				<img src="/img/ico-search.svg" alt="Rechercher"/>
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
			<img src="img/ico-twitter.svg" alt="Twitter"/>
		</a>
		<a class="mobileSocial__item" href="" title="Chaine Youtube">
			<img src="img/ico-youtube.svg" alt="Youtube"/>
		</a>
		<a class="mobileSocial__item" href="" title="Profil Instagram">
			<img src="img/ico-instagram.svg" alt="Instagram"/>
		</a>
		<a class="mobileSocial__item" href="" title="Page Facebook">
			<img src="img/ico-facebook.svg" alt="Facebook"/>
		</a>
		<a class="mobileSocial__item" href="" title="Flux RSS">
			<img src="img/ico-rss.svg" alt="RSS"/>
		</a>
		</li>
		</ul>
	</div>
</div>