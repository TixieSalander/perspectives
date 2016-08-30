<?php

use App\Cache\CacheManager;
use App\Cache\DataCache;
use App\Cache\UrlCache;
use App\Utils;
use Bolandish\Instagram;


$dataCache = new DataCache();
$urlCache = new UrlCache();
$theme_path = get_bloginfo("template_directory");
$imgCache = new UrlCache('img/cache/');
$img_expire = 86400 * 7;
$isImgCacheRefModified = false;


$data = $dataCache->readOrWrite('instagram', function () {
	$data = json_encode(Instagram::getMediaByUserID('3166050484', 10, true));

	if (is_null($data))
		return UrlCache::$_no_write;
	else
		return $data;

}, 1800, $urlCache::$_no_delete);


$data = json_decode($data, true);


$imgCacheRef_content = $dataCache->readOrWrite("img-cache", function ($data) use ($imgCache, $img_expire) {


	if (empty($data))
		return CacheManager::$_no_write;

	$lines = explode("\n", $data);

	foreach ($lines as $key => $line) {
		$cache_raw = explode(",", $line);

		$cacheFilename = $cache_raw[0];

		if ($imgCache->isCacheEntryExpired($cacheFilename, $img_expire))
			$imgCache->remove($cacheFilename);

		unset($lines[ $key ]);
	}

	$toWrite = join("\n", $lines);

	return $toWrite;

}, 86400 * 2, CacheManager::$_no_delete);

$newImgCacheRefs = [];

if (empty($imgCacheRef_content)) {
	$imgCacheRef = [];
}else {
	$imgCacheRef = explode("\n", $imgCacheRef_content);
}


?>

<!-- Footer -->
<footer class="footer">
	<!-- Instagram Gallery -->
	<ul class="instaGallery">

		<?php foreach ($data as $insta) :

			$thumb_id = null;
			$url = $insta['thumbnail_src'];

			foreach ($imgCacheRef as $ref) {

				$raw = explode(",", $ref, 2);

				if ($url === $raw[1]) {
					$thumb_id = $raw[0];
				}

			}

			if (empty($thumb_id)) {
				$thumb_id = uniqid('', true);

				$isImgCacheRefModified = true;

				$newImgCacheRefs[] = "$thumb_id,$url\n";
			}

			?>

			<li class="instaGallery__item">
				<a class="instaGallery__link" target="_blank" href="https://www.instagram.com/p/<?= $insta['code'] ?>"
				   title="<?= $insta['caption'] ?>">
					<img class="instaGallery__image"
					     src="<?= $theme_path . '/img/cache/' . $thumb_id ?>"
					     alt="<?= $insta['caption'] ?>"/>
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
						<img src="<?= $theme_path ?>/img/logo-collectif.svg" alt="Le collectif Perspectives"/>
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
<?php

if ($isImgCacheRefModified) {
	$imgCacheRef = array_merge($imgCacheRef, $newImgCacheRefs);
	$dataCache->write('img-cache', join("", $imgCacheRef));
}
?>
<?php get_search_form() ?>

<?php wp_enqueue_script("script", get_template_directory_uri() . '/js/script.js'); ?>
<?php wp_footer() ?>

</body>
</html>