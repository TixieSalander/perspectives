<?php


namespace App\Cache;

use Eliepse\Cache\Cache;

class DataCache extends Cache
{

	public function initConfigs($url = false)
	{
		parent::initConfigs();
		
		if ($url === false && isset($this->cache_config->paths['data']))
			$this->cache_path = $this->path_base . $this->cache_config->paths['data'];
	}

}