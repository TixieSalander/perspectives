<?php get_header() ?>

<?php
$path = str_replace('\\', '/', __DIR__ . '/inc/post_types_cards/PostTypesCardFactory.php');
include_once __DIR__ . '/inc/post_types_cards/PostTypesCardFactory.php';
$cardFactory = PostTypesCardFactory::getInstance();
?>

	<!-- Home timeline -->
	<section class="home">
		<div class="container">

			<?php

			$current_page = intval(get_query_var('page'));

			query_posts([
				'posts_per_page' => '15',
				'post_type'      => ['post', 'chronique', 'evenement', 'dossier'],
				'paged'          => $current_page,
			]);
			?>


			<?= $cardFactory->printHomeModule(2, 1); ?>
			<?= $cardFactory->printHomeModule(1, 2); ?>
			<?= $cardFactory->printHomeModule(2, 1); ?>


			<!-- Pagination module -->
			<div class="pagination">
				<!-- More button -->
				<!-- <a class="pagination__more" href="" title="Afficher les publications suivantes">Afficher plus</a> -->
				<!-- Page number list -->
				<?php

				global $wp_query;

				$max_page = intval($wp_query->max_num_pages);
				$mid_size = 2;

				?>


				<ul class="pagination__list">

					<?php

					function printHtmlNumber($text, $page, $class = '')
					{
						echo "<li class=\"pagination__item\">
							<a class=\"pagination__itemContent $class\" href=\"?page=$page\">$text</a>
						</li>";
					}

					function printDesactivated() {
						echo '<li class="pagination__item">
								<span class="pagination__itemContent pagination__itemContent--desactivated">…</span>
							</li>';
					}

					if ($current_page > 1)
						printHtmlNumber("«", $current_page - 1);

					printHtmlNumber("1", 1, $current_page === 1 ? 'pagination__itemContent--current' : '');

					if($current_page - $mid_size > 1)
						printDesactivated();

					for($i = $current_page - $mid_size + 1; $i > 1 && $i < $current_page + $mid_size && $current_page < $max_page; $i++)
						printHtmlNumber($i, $i, $current_page === $i ? 'pagination__itemContent--current' : '');

					if($current_page + $mid_size < $max_page)
						printDesactivated();

					printHtmlNumber($max_page, $max_page, $max_page === $current_page ? 'pagination__itemContent--current' : '');

					if ($current_page < $max_page)
						printHtmlNumber("»", $current_page + 1);

					?>

				</ul>

			</div>
		</div>
	</section>

	<!--<script src="/js/script.js"></script>-->

<?php get_footer() ?>