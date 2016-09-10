<?php

get_header();
?>

	<div class="container">
		<section class="articleList">
			<div class="articleList__head">
				<hr/>
				<?php if (is_search()) : ?>
					<span class="articleList__smallTitle">Résultat de : </span>
					<span class="articleList__bigTitle"><?= the_search_query(); ?></span>
				<?php elseif (is_category()) : ?>
					<span class="articleList__smallTitle">Articles publiés dans : </span>
					<span class="articleList__bigTitle"><?= single_cat_title(); ?></span>
				<?php else: ?>
					<span class="articleList__smallTitle">Articles du mois de : </span>
					<span class="articleList__bigTitle"><?= ucfirst(get_the_date('F Y')); ?></span>
				<?php endif; ?>
			</div>

			<?php get_template_part('loop'); ?>

			<?= include 'pagination.php'; ?>

		</section>
	</div>

<?php
get_footer();
