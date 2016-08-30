<?php


namespace App\Cache;


use Error;

class UrlCache extends CacheManager
{

	public function initConfigs($url = false)
	{
		parent::initConfigs();

		if ($url === false && isset($this->cache_config->paths['url']))
			$this->cache_path = $this->path_base . $this->cache_config->paths['url'];
	}


	public function readOrCacheUrl($name, $url, $expire = null, $flags = null)
	{
		$data = $this->read($name, $expire, $flags);

		if (is_null($data)) {
			$data = file_get_contents($url);
			$this->write($name, $data);
		}

		return $data;
	}


	public function ensureCacheFolder()
	{
		if (!file_exists($this->cache_path))
			mkdir($this->cache_path, 0755, true);
	}

}