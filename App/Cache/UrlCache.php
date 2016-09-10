<?php


namespace App\Cache;

class UrlCache extends CacheManager
{

	static public $_rtn_is_valid = 0x20;

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

			$url_content = file_get_contents($url);

			if ($flags & self::$_rtn_is_valid)
				$data = is_null($data) ? false : true;
			else
				$data = $url_content;

			$this->write($name, $url_content);
		}

		return $data;
	}


	public function ensureCacheFolder()
	{
		if (!file_exists($this->cache_path))
			mkdir($this->cache_path, 0755, true);
	}

}