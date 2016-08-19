<?php

use App\PostTypesCardFactory;

$cardFactory = PostTypesCardFactory::getInstance();

?>
<div class="container">
	<section class="articleList">
		<div class="articleList__head">
			<hr/>
			<?php if(is_search()) : ?>
				<span class="articleList__smallTitle">Résultat de : </span>
				<span class="articleList__bigTitle"><?= the_search_query(); ?></span>
			<?php else: ?>
				<span class="articleList__smallTitle">Articles du mois de : </span>
				<span class="articleList__bigTitle">Janvier 2015</span>
			<?php endif; ?>
		</div>
		<div class="articleList__grid-list articleList__grid-list-m articleList__grid-list-s">
			<?php
			if(have_posts()) {
				while ($post = $cardFactory->getCard()) {
					echo $post;
				}
			}
			?>
		</div>

		<?= include 'pagination.php'; ?>

	</section>
</div>