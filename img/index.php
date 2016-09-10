<?php

require '../vendor/autoload.php';

use App\Cache\CacheManager;
use App\Cache\DataCache;
use App\Cache\UrlCache;
use Gregwar\Image\Image;

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

function send304($tsstring, $type)
{
	header('HTTP/1.1 304 Not Modified');
	header("Last-Modified: $tsstring");
	header('Content-Transfer-Encoding: binary');
	header("Content-Type: image/$type");
	exit();
}

function send200($abs_path, $tsstring, $type, $modifiedAt, $etag, $img_expire, $cache_file_size)
{
	header("Cache-Control: public, max-age=" . $img_expire, true);
	header('Last-Modified: ' . $tsstring, true);
	header('Pragma: public', true);
	header('Content-Transfer-Encoding: binary', true);
	header('Content-Length: ' . $cache_file_size, true);
	header('Date: ' . gmdate('D, d M Y H:i:s ', time()), true);
	header('Expires: ' . $modifiedAt->add(new DateInterval('PT' . $img_expire . 'S'))->format('rfc1123'), true);
	header("Content-Type: image/$type", true);
	header("Tag: {$etag}", true);
	$file = fopen($abs_path, 'r');
	fpassthru($file);
	exit;
}

function cropAndCompressImage($url)
{
	Image::open($url)
		->zoomCrop(250, 250)
		->save($url, 'guess', 55);
}

if (empty($_GET['id'])
	|| !preg_match('/^[a-zA-Z0-9.]{23}\.[a-zA-Z]+$/', $_GET['id'])
) {
	send404();
}

$img_ref = $_GET['id'];
$img_expire = 86400 * 7;
$dataCache = new DataCache();
$imgCache = new UrlCache('img/cache/');

$imgCacheRef_content = $dataCache->read("img-cache", false, CacheManager::$_no_delete);
$imgCacheRefs = json_decode($imgCacheRef_content, true);

foreach ($imgCacheRefs as $id => $url) {

	if ($id === $img_ref) {
		response($url, $id);
		exit;
	}

}

/**
 * @param string $cacheUrl
 * @param string $cacheFilename
 */
function response($cacheUrl, $cacheFilename)
{
	global $img_expire, $imgCache;

	$isFileValid = $imgCache->readOrCacheUrl($cacheFilename, $cacheUrl, $img_expire, CacheManager::$_no_delete | UrlCache::$_rtn_is_valid);

	$cache_file = $imgCache->getFileCache($cacheFilename);

	if (!$cache_file->isFileExist())
		send404();

	if (!$isFileValid)
		cropAndCompressImage($cache_file->getAbsolutePath());

	$modifiedAt = empty($cache_file->getModifiedAt()) ? new DateTime() : $cache_file->getModifiedAt();

	$abs_path = $cache_file->getAbsolutePath();
	$cache_file_size = filesize($abs_path);
	$type = pathinfo($cacheFilename, PATHINFO_EXTENSION);

	$tsstring = $modifiedAt->format('rfc1123');
	$etag = md5($cacheFilename . $modifiedAt->getTimestamp());

	$if_modified_since = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false;
	$if_none_match = isset($_SERVER['HTTP_IF_NONE_MATCH']) ? $_SERVER['HTTP_IF_NONE_MATCH'] : false;

	if ((($if_none_match && $if_none_match == $etag) || !$if_none_match)
		&& ($if_modified_since && $if_modified_since == $tsstring)
	) {
		send304($tsstring, $type);
	} else {
		send200($abs_path, $tsstring, $type, $modifiedAt, $etag, $img_expire, $cache_file_size);
	}
}

// si rien n'a été trouvé, alors on retourne une erreur 404
send404();
