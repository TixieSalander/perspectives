<?php
get_header();
?>

	<!-- Single article -->
	<div class="container">
		<section class="single">
			<div class="single-content">
				<?php if (have_posts()) :
					the_post();
					?>
					<div class="single-pageHead">
						<h1 class="single-pageHead__title"><?= the_title(); ?></h1>
					</div>
					<div class="single-article">
						<div class="single-article__content">
							<?= the_content(); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</section>
	</div>


<?php
get_footer();
