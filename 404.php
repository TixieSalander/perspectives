<?php
get_header();
?>

	<div class="container">
		<section class="single">
			<div class="single-content">
					<div class="single-pageHead">
						<h1 class="single-pageHead__title">404 - Page non trouvée ! :(</h1>
					</div>
					<div class="single-article">
						<div class="single-article__content">
							<p>Oh Malheureusement la page à laquelle vous avez essayé d'accéder n'existe pas. Contactez nous si vous trouvez ça anormal.<br/>Peut-être que l'article que vous cherchez se trouve dans la liste des derniers articles :</p>
							<ul class="error-page-list">
								<?php
									$recentPosts = new WP_Query();
									$recentPosts->query('showposts=20');
								?>
								<?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
									<li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>
								<?php endwhile; ?>
								</ul>
							<p class="error-page-text">Et sinon vous pouvez revenir à  <a href="<?php echo home_url() ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php _e('la page d\'accueil','att'); ?></a>.</p>
						</div>
					</div>
			</div>
		</section>
	</div>

<?php
get_footer();
