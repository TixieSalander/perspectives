<?php


namespace App\Cache;


use Error;

class UrlCache extends CacheManager
{

	public function initConfigs()
	{
		parent::initConfigs();

		if (isset($this->cache_config->paths['url']))
			$this->cache_path = $this->path_base . $this->cache_config->paths['url'];
	}


	public function getBasenameOrCacheUrl($url, $expire = null)
	{
		$name = $this->getBasename($url, $expire);

		if (is_null($name))
			$name = $this->cacheUrl($url);

		return $name;
	}


	public function getBasename($url, $expire = null)
	{
		$name = $this->getNameFromUrl($url);
		$cache_file = $this->getFileCache($name);

		if ($this->isCacheFileValid($cache_file, $expire)) {
			return $name;
		}else {
			return null;
		}
	}


	public function cacheUrl($url)
	{
		$file_content = file_get_contents($url);

		$name = $this->getNameFromUrl($url);

		$this->write($name, $file_content);

		return $name;
	}


	public function ensureCacheFolder()
	{
		if (!file_exists($this->cache_path))
			mkdir($this->cache_path, 0755, true);
	}


	private function getNameFromUrl($url)
	{
		$url_parsed = parse_url($url);
		$baename = pathinfo($url_parsed['path'], PATHINFO_BASENAME);
		$extension = pathinfo($url_parsed['path'], PATHINFO_EXTENSION);

		$blueprint = "host|basename";

		$name_raw = str_replace([
			'scheme',
			'host',
			'path',
			'query',
			'basename',
		], [
			$url_parsed['scheme'],
			$url_parsed['host'],
			$url_parsed['path'],
			$url_parsed['query'],
			$baename,
		], $blueprint);

		$name_64 = $this->base64url_encode($name_raw);


		if (!empty($extension))
			$name_64 .= ".$extension";

		if (strlen($name_64) > 220) {
			throw new Error();

			return false;
		}

		return $name_64;

	}


	private function base64url_encode($data)
	{
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
	}


	private function base64url_decode($data)
	{
		return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
	}

}