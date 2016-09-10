<?php

get_header();

use App\PostTypesCardFactory;
use App\Utils;

$cardFactory = PostTypesCardFactory::getInstance();

if (have_posts()) :
	the_post();
	
	?>
	
	<!-- Single article -->
	<div class="container">
		<section class="single">
			<div class="single-content">
				<div class="single-head">
					<img class="single-head__image" src="<?= get_the_post_thumbnail_url() ?>"/>
				</div>
				<div class="single-author">
					<span class="single-author__title">L'auteur·e</span>
					<div class="single-author__avatar">
						<img src="<?= get_avatar_url(get_the_author_meta('user_email')); ?>" alt="Avatar"/>
					</div>
					<div class="single-author__about">
						<span class="single-author__name"><?= the_author_meta('display_name') ?></span>
						<span class="single-author__bio"><?= the_author_meta('description') ?></span>
						<?php
						//						$url = get_the_author_meta('user_url');
						global $authordata;
						//						if (!empty($url)) :
						?>
						<a class="single-author__button" href="<?= get_author_posts_url($authordata->ID); ?>">En savoir plus</a>
						<!--						--><?php //endif;
						?>
					</div>
				</div>
				<div class="single-article">
					<div class="single-article__head">
						<h1 class="single-article__title"><?= get_the_title() ?></h1>
						<div class="single-article__info">
							<?php
							$cats = get_the_category();
							
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
				
				<?php

				$tags = get_the_tags();
				$tag_list_str = [];

				if (!is_array($tags))
					$tags = [];

				foreach ($tags as $tag) {
					$tag_list_str[] = $tag->name;
				}

				$tag_list_str = join(',', $tag_list_str);
				$permalink = urlencode(get_the_permalink());

				$twitter = Utils::getShareLink('twitter', [
					'{url}'      => $permalink,
					'{title}'    => get_the_title(),
					'{via}'      => pathinfo(get_option('rs_twitter', ''), PATHINFO_BASENAME),
					'{hashtags}' => $tag_list_str,
				]);

				$facebook = Utils::getShareLink('facebook', [
					'{url}' => $permalink,
				]);

				$google = Utils::getShareLink('google+', [
					'{url}' => $permalink,
				]);

				$pinterest = Utils::getShareLink('pinterest', [
					'{url}'      => $permalink,
					'{title}'    => get_the_title(),
					'{img}'      => urlencode(get_the_post_thumbnail_url()),
					'{is_video}' => has_post_format('video'),
				]);

				?>
				
				<ul class="single-share">
					<li class="single-share__item">
						<a class="single-share__link single-share__link--twitter" href="<?= $twitter ?>" target="_blank" title="Share on twitter">
							<img class="single-share__icon" src="<?= bloginfo("template_directory") ?>/img/ico-share-twitter.svg" alt="Twitter"/>
						</a>
					</li>
					<li class="single-share__item">
						<a class="single-share__link single-share__link--facebook" href="<?= $facebook ?>" target="_blank" title="Share on Facebook">
							<img class="single-share__icon" src="<?= bloginfo("template_directory") ?>/img/ico-share-facebook.svg" alt="Facebook"/>
						</a>
					</li>
					<li class="single-share__item">
						<a class="single-share__link single-share__link--googleplus" href="<?= $google ?>" target="_blank" title="Share on Google+">
							<img class="single-share__icon" src="<?= bloginfo("template_directory") ?>/img/ico-share-googleplus.svg" alt="Google +"/>
						</a>
					</li>
					<li class="single-share__item">
						<a class="single-share__link single-share__link--pinterest" href="<?= $pinterest ?>" target="_blank" title="Share on Pinterest">
							<img class="single-share__icon" src="<?= bloginfo("template_directory") ?>/img/ico-share-pinterest.svg" alt="Pinterest"/>
						</a>
					</li>
				</ul>
			</div>
			
			<!-- Article suggestions -->
			<?= $cardFactory->getRelated(); ?>
		
		</section>
	</div>
<?php endif; ?>
<?php get_footer() ?>