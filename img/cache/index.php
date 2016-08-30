<?php

require '../../vendor/autoload.php';

use App\Cache\CacheManager;
use App\Cache\DataCache;
use App\Cache\UrlCache;

function send404()
{
	header('HTTP/1.0 404 Not Found');
	exit;
}

function send403()
{
	header('HTTP/1.0 403 Forbidden');
	exit;
}

if (empty($_GET['id'])
	|| !preg_match('/[a-zA-Z0-9.]{23}/', $_GET['id'])
) {
	send404();
}

$img_ref = $_GET['id'];
$img_expire = 86400 * 7;
$dataCache = new DataCache();
$imgCache = new UrlCache('cache/img/');

$imgCacheRef_content = $dataCache->read("img-cache", false, CacheManager::$_no_delete);
$imgCacheRefs = explode("\n", $imgCacheRef_content);

foreach ($imgCacheRefs as $line) {

	if(empty($line))
		continue;

	$cache_raw = explode(",", $line);

	if(empty($cache_raw))
		continue;

	$cacheFilename = $cache_raw[0];
	$cacheUrl = $cache_raw[1];

	if ($cacheFilename === $img_ref) {

		echo $imgCache->readOrCacheUrl($cacheFilename, $cacheUrl, $img_expire, CacheManager::$_no_delete);

		exit;
	}
}

// si rien n'a été trouvé, alors on retourne une erreur 404
send404();