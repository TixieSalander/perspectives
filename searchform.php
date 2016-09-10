<!-- Search desktop module -->
<div class="search" data-js="search">
	<button class="search__close" data-js="topSearchClose">
		<img src="<?= bloginfo("template_directory") ?>/img/ico-close.svg" alt="X" />
	</button>
	<form class="search__form" action="<?= bloginfo('url') ?>/" method="GET">
		<input class="search__input" data-js="topSearchInput" type="search" placeholder="Tapez un mot clé" value="<?= the_search_query() ?>" name="s" id="s" />
		<button class="search__searchButton" role="button" type="submit">
			<img src="<?= bloginfo("template_directory") ?>/img/ico-search.svg" alt="Rechercher" />
		</button>
	</form>
</div>