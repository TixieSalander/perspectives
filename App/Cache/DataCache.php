<?php


namespace App\Cache;

class DataCache extends CacheManager
{

	public function initConfigs($url = false)
	{
		parent::initConfigs();
		
		if ($url === false && isset($this->cache_config->paths['data']))
			$this->cache_path = $this->path_base . $this->cache_config->paths['data'];
	}

}