<?php


namespace App\Cache;

use Eliepse\Cache\Cache;

class UrlCache extends Cache
{

	protected $type = 'url';
	static public $_rtn_is_valid = 0x20;

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