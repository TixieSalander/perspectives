<?php

use App\Utils;

get_header();

global $authordata;

?>

	<!-- Single article -->
	<div class="container">
		<section class="articleList" itemscope itemtype="http://schema.org/Person">
			<div class="articleList__author" style="background-image: url(<?= bloginfo("template_directory"); ?>/img/author-bg.jpg)">
				<?php $user_post_count = count_user_posts( $authordata->ID ); ?>
				<div class="articleList__authorNumber"><strong><?= $user_post_count ?></strong> Article<?= $user_post_count > 1 ? "s" : "" ?></div>
				<div class="articleList__authorAvatar">
					<img src="<?= get_avatar_url(get_the_author_meta('user_email')); ?>" alt="Avatar" itemprop="image"/>
				</div>
				<h1 class="articleList__authorName" itemprop="name"><?= the_author_meta('display_name') ?></h1>
				<div class="articleList__authorAbout">
					<?= the_author_meta('description') ?>
				</div>
				<?php

				$links_refs = [
					'user_url' => 'Site web',
					'twitter'  => 'Twitter',
					'facebook' => 'Facebook',
				];

				$author_links = [];

				foreach ($links_refs as $meta => $txt) {

					$meta = get_the_author_meta($meta);

					if (empty($meta)) continue;

					$author_links[] = "<a href='$meta'>$txt</a>";

				}

				echo Utils::makeList($author_links, ["class" => 'articleList__authorLinks']); ?>

			</div>

			<?php get_template_part('loop'); ?>

			<?php include "pagination.php"; ?>

		</section>
	</div>

<?php
get_footer();
