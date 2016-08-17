<?php

use App\Cache;
use App\Utils;
use Bolandish\Instagram;

$cache = Cache::getInstance();

$data = $cache->read('instagram', 1800);

if (empty($data)) {

	$data = Instagram::getMediaByUserID('3166050484', 10, true);
	$cache->write('instagram', json_encode($data));

}else {

	$data = json_decode($data, true);
	
}


?>

<!-- Footer -->
<footer class="footer">
	<!-- Instagram Gallery -->
	<ul class="instaGallery">

		<?php foreach ($data as $insta) : ?>

			<li class="instaGallery__item">
				<a class="instaGallery__link" target="_blank" href="https://www.instagram.com/p/<?= $insta['code'] ?>" title="<?= $insta['caption'] ?>">
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
							<a class="footerSocial__item" href="" title="Profil Twitter">
								<img src="<?= bloginfo("template_directory") ?>/img/ico-twitter.svg" alt="Twitter"/>
							</a>
							<a class="footerSocial__item" href="" title="Chaine Youtube">
								<img src="<?= bloginfo("template_directory") ?>/img/ico-youtube.svg" alt="Youtube"/>
							</a>
							<a class="footerSocial__item" href="" title="Profil Instagram">
								<img src="<?= bloginfo("template_directory") ?>/img/ico-instagram.svg" alt="Instagram"/>
							</a>
							<a class="footerSocial__item" href="" title="Page Facebook">
								<img src="<?= bloginfo("template_directory") ?>/img/ico-facebook.svg" alt="Facebook"/>
							</a>
							<a class="footerSocial__item" href="" title="Flux RSS">
								<img src="<?= bloginfo("template_directory") ?>/img/ico-rss.svg" alt="RSS"/>
							</a>
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