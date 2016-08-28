<?php


namespace App\Cache;

class DataCache extends CacheManager
{

	/**
	 * Overwrite CacheManager
	 * DataCache constructor.
	 */
	public function __construct()
	{
		if (isset($this->cache_config->paths['data']))
			$this->cache_path = $this->path_base . $this->cache_config->paths['data'];

		parent::__construct();
	}

}