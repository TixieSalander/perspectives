<?php

use App\Cache\DataCache;
use App\Utils;
use Bolandish\Instagram;


$cache = DataCache::getInstance();

$data = $cache->readOrWrite('instagram', function () {
	return json_encode(Instagram::getMediaByUserID('3166050484', 10, true));
}, 1800);

$data = json_decode($data, true);

?>

<!-- Footer -->
<footer class="footer">
	<!-- Instagram Gallery -->
	<ul class="instaGallery">

		<?php foreach ($data as $insta) : ?>

			<li class="instaGallery__item">
				<a class="instaGallery__link" target="_blank" href="https://www.instagram.com/p/<?= $insta['code'] ?>"
				   title="<?= $insta['caption'] ?>">
					<img class="instaGallery__image" src="<?= $insta['thumbnail_src'] ?>" alt="<?= $insta['caption'] ?>"/>
				</a>
			</li>

		<?php endforeach; ?>

	</ul>
	<!-- Footer bottom -->
	<div class="container">
		<div class="footer__bottom grid-2">
			<div class="txtcenter">
				<div class="footer__collectif">
					<a href="" title="Le collectif Perspectives">
						<img src="<?= bloginfo("template_directory") ?>/img/logo-collectif.svg" alt="Le collectif Perspectives"/>
					</a>
				</div>
			</div>
			<div class="txtcenter">
				<div class="footerContact">
					<ul>
						<li class="footerSocial">
							Restez en contact<br/>

							<?= Utils::getSocials([], false, false, 'footerSocial__item'); ?>

						</li>

						<?= Utils::getWPMenu('footer-menu', false); ?>

					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php get_search_form() ?>

<?php wp_enqueue_script("script", get_template_directory_uri() . '/js/script.js'); ?>
<?php wp_footer() ?>

</body>
</html>