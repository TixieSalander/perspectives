<!-- Pagination module -->
<div class="pagination">
	<?php

	global $wp_query;
	$current_page = max(intval(get_query_var('paged', 1)), 1);
	$max_page = intval($wp_query->max_num_pages);
	$mid_size = 2;

	if ($max_page > 1) :

		?>

		<?php if ($current_page < $max_page) : ?>
		
		<!-- More button -->
		<a class="pagination__more" href="<?= esc_url(get_pagenum_link($current_page + 1)) ?>" title="Afficher les publications suivantes">Afficher
			plus</a>
		<!-- Page number list -->

		<?php endif; ?>


		<ul class="pagination__list">

			<?php

			function printHtmlNumber($text, $page, $class = '')
			{
				echo "<li class=\"pagination__item\">
							<a class=\"pagination__itemContent $class\" href='" . esc_url(get_pagenum_link($page)) . "'>$text</a>
						</li>";
//							<a class=\"pagination__itemContent $class\" href='?page=$page'>$text</a>
			}

			function printDesactivated()
			{
				echo '<li class="pagination__item">
								<span class="pagination__itemContent pagination__itemContent--desactivated">…</span>
							</li>';
			}

			if ($current_page > 1)
				printHtmlNumber("«", $current_page - 1);

			printHtmlNumber("1", 1, $current_page === 1 ? 'pagination__itemContent--current' : '');

			if ($current_page - $mid_size > 1)
				printDesactivated();

			for ($i = $current_page - $mid_size + 1; $i > 1 && $i < $current_page + $mid_size && $current_page < $max_page; $i++)
				printHtmlNumber($i, $i, $current_page === $i ? 'pagination__itemContent--current' : '');

			if ($current_page + $mid_size < $max_page)
				printDesactivated();

			printHtmlNumber($max_page, $max_page, $max_page === $current_page ? 'pagination__itemContent--current' : '');

			if ($current_page < $max_page)
				printHtmlNumber("»", $current_page + 1);

			?>

		</ul>
	<?php endif; ?>
</div>
