<?php

get_header();

if (have_posts()) :
	the_post();


//	$title = get_the_title();
//	$permalink = get_the_permalink();
//	$thumbnail = get_the_post_thumbnail_url();
//	$type_name = get_post_type();
//	$format_name = get_post_format();
//	$excerpt = get_the_excerpt();

	?>

	<!-- Single article -->
	<div class="container">
		<section class="single">
			<div class="single-content">
				<div class="single-head">
					<img class="single-head__image" src="<?= get_the_post_thumbnail_url() ?>"/>
				</div>
				<div class="single-author">
					<span class="single-author__title">L'auteur-e</span>
					<div class="single-author__avatar">
						<img src="<?= get_avatar_url(get_the_author_meta('user_email')); ?>" alt="Avatar"/>
					</div>
					<div class="single-author__about">
						<span class="single-author__name"><?= the_author_meta('nickname') ?></span>
						<span class="single-author__bio"><?= the_author_meta('description') ?></span>
						<?php
						$url = get_the_author_meta('user_url');

						if (!empty($url)) :
							?>
							<a class="single-author__button" href="<?= $url; ?>">En savoir plus</a>
						<?php endif; ?>
					</div>
				</div>
				<div class="single-article">
					<div class="single-article__head">
						<h1 class="single-article__title"><?= get_the_title() ?></h1>
						<div class="single-article__info">
							<?php
							$cats = get_the_category();
							//							var_dump(get_class_methods('WP_Term'));
							//							var_dump($cats);

							$cat_html = [];
							
							foreach ($cats as $cat) {

								$cat_link = get_category_link($cat->cat_ID);
								$cat_name = $cat->cat_name;

								$cat_html[] = "<a href=\"$cat_link\">$cat_name</a>";
							}

							?>
							Publié <?php echo empty($cat_html) ? 'le ' . get_the_date() : implode(', ', $cat_html) . ' • Le ' . get_the_date(); ?>
						</div>
					</div>
					<div class="single-article__content">

						<?php the_content(); ?>

					</div>

				</div>
				<ul class="single-share">
					<li class="single-share__item">
						<a class="single-share__link single-share__link--twitter" href="" title="">
							<img class="single-share__icon" src="<?= bloginfo("template_directory") ?>/img/ico-share-twitter.svg" alt="Twitter"/>
						</a>
					</li>
					<li class="single-share__item">
						<a class="single-share__link single-share__link--facebook" href="" title="">
							<img class="single-share__icon" src="<?= bloginfo("template_directory") ?>/img/ico-share-facebook.svg" alt="Facebook"/>
						</a>
					</li>
					<li class="single-share__item">
						<a class="single-share__link single-share__link--googleplus" href="" title="">
							<img class="single-share__icon" src="<?= bloginfo("template_directory") ?>/img/ico-share-googleplus.svg" alt="Google +"/>
						</a>
					</li>
					<li class="single-share__item">
						<a class="single-share__link single-share__link--pinterest" href="" title="">
							<img class="single-share__icon" src="<?= bloginfo("template_directory") ?>/img/ico-share-pinterest.svg" alt="Pinterest"/>
						</a>
					</li>
				</ul>
			</div>
			<!-- Article suggestions -->
			<div class="single-suggestion">
				<h3 class="single-suggestion__title">Ces articles peuvent aussi vous intéresser</h3>
				<div class="single-suggestion__list grid-3 grid-2-m grid-1-s">
					<a class="single-suggestion__item fpostVideo" style="background-image: url('<?= bloginfo("template_directory") ?>/img/demo/miniature_loewy-1024-576.jpg')">
						<div class="fpostVideo__content">
							<h2 class="fpostVideo__title">L'homme qui créa la bouteille de Coca-Cola</h2>
							<div class="fpostVideo__play">
								<svg xmlns="http://www.w3.org/2000/svg" width="70" viewBox="-1 -1 62 62">
									<path class="fpostVideo__playTriangle" fill="transparent" fill-rule="evenodd" stroke="#FFF" stroke-width="2"
									      d="M30 60c16.57 0 30-13.43 30-30S46.57 0 30 0 0 13.43 0 30s13.43 30 30 30zm-8-41.01c0-1.65 1.136-2.274 2.545-1.387l16.91 10.646c1.405.884 1.41 2.317 0 3.204L24.545 42.1c-1.405.886-2.545.267-2.545-1.387V18.99z"/>
								</svg>
							</div>
							<div class="fpostVideo__cat">
								<svg width="10px" height="11px" viewBox="0 5 10 11" version="1.1" xmlns="http://www.w3.org/2000/svg"
								     xmlns:xlink="http://www.w3.org/1999/xlink">
									<path stroke="none" fill="#000000" fill-rule="evenodd"
									      d="M1.43333333,5.83291667 L1.25041667,5 L8.74791667,5 L8.565,5.83291667 L1.43333333,5.83291667 L1.43333333,5.83291667 Z M0,8.33333333 L0.847916667,15 L9.12625,15 L10,8.33333333 L0,8.33333333 L0,8.33333333 Z M9.27291667,7.5 L9.4275,6.66666667 L0.570833333,6.66666667 L0.725416667,7.5 L9.27291667,7.5 L9.27291667,7.5 Z"></path>
								</svg>
								Dossier
							</div>
						</div>
					</a>
					<a class="single-suggestion__item fpostDossier">
						<h2 class="fpostDossier__title">Comment le Blackberry Passeport pourrait devenir un cas d'école</h2>
						<p class="fpostDossier__extract">Avez vous entendu parlé il y a quelques mois, Blackberry avait annoncé deux modèles dont l’un
							se séparait du sacro-sain clavier AZERTY mécanique.</p>
						<div class="fpostDossier__cat">
							<svg width="10px" height="11px" viewBox="0 5 10 11" version="1.1" xmlns="http://www.w3.org/2000/svg"
							     xmlns:xlink="http://www.w3.org/1999/xlink">
								<path stroke="none" fill="#000000" fill-rule="evenodd"
								      d="M1.43333333,5.83291667 L1.25041667,5 L8.74791667,5 L8.565,5.83291667 L1.43333333,5.83291667 L1.43333333,5.83291667 Z M0,8.33333333 L0.847916667,15 L9.12625,15 L10,8.33333333 L0,8.33333333 L0,8.33333333 Z M9.27291667,7.5 L9.4275,6.66666667 L0.570833333,6.66666667 L0.725416667,7.5 L9.27291667,7.5 L9.27291667,7.5 Z"></path>
							</svg>
							Dossier
						</div>
					</a>
					<a class="single-suggestion__item fpostArticle">
						<div class="fpostArticle__image" style="background-image: url('<?= bloginfo("template_directory") ?>/img/demo/Phallaina_promo_07-1024-524.jpg');"></div>
						<div class="fpostArticle__content">
							<h2 class="fpostArticle__title">Phallaina — La première bande défilée</h2>
							<div class="fpostArticle__cat">
								<svg width="10px" height="11px" viewBox="0 5 10 11" version="1.1" xmlns="http://www.w3.org/2000/svg"
								     xmlns:xlink="http://www.w3.org/1999/xlink">
									<path stroke="none" fill="#FFFFFF" fill-rule="evenodd"
									      d="M1.43333333,5.83291667 L1.25041667,5 L8.74791667,5 L8.565,5.83291667 L1.43333333,5.83291667 L1.43333333,5.83291667 Z M0,8.33333333 L0.847916667,15 L9.12625,15 L10,8.33333333 L0,8.33333333 L0,8.33333333 Z M9.27291667,7.5 L9.4275,6.66666667 L0.570833333,6.66666667 L0.725416667,7.5 L9.27291667,7.5 L9.27291667,7.5 Z"></path>
								</svg>
								Évènement
							</div>
						</div>
					</a>
				</div>
			</div>
		</section>
	</div>
<?php endif; ?>
<?php get_footer() ?>