<?php


namespace App\Cache;


use App\ConfigFactory;
use DateInterval;

class CacheManager implements CacheInterface
{

	static protected $_instances;
	protected $path_base = __DIR__ . '/../../';
	protected $files_cache;
	protected $cache_path;
	protected $cache_config;
	protected $cache_extension;


	/**
	 * CacheManager constructor.
	 */
	protected function __construct()
	{
		$this->initConfigs();
		$this->ensureCacheFolder();
	}


	/**
	 * @return CacheManager
	 */
	final public static function getInstance()
	{
		self::$_instances = array();

		$calledClass = get_called_class();

		if (!isset($instances[ $calledClass ])) {
			$instances[ $calledClass ] = new $calledClass();
		}

		return $instances[ $calledClass ];
	}


	/**
	 * @param string $name
	 * @param null|int|bool $expire The expire time in seconds
	 * @return mixed|null
	 */
	public function read($name, $expire = null)
	{
		$cache_file = $this->getFileCache($name . $this->cache_extension);

		if (!$this->isCacheFileValid($cache_file, $expire)) {
			$this->remove($name);

			return null;
		}

		return $cache_file->getData();
	}


	public function write($name, $value = null)
	{
		$cache_file = $this->getFileCache($name . $this->cache_extension);
		$cache_file->setData($value);

		return $cache_file->getData();
	}


	public function readOrWrite($name, $toWrite, $expire = null)
	{
		$data = $this->read($name, $expire);

		if (is_null($data)) {

			if (is_callable($toWrite))
				$data = $this->write($name, $toWrite());
			else
				$data = $this->write($name, $toWrite);

		}

		return $data;
	}


	/**
	 * Remove a cache element
	 *
	 * @param string $cache
	 */
	public function remove($cache)
	{
		$this->getFileCache($cache)->delete();
		unset($this->files_cache[ $cache ]);
	}


	protected function initConfigs()
	{
		$this->files_cache = [];
		$this->cache_config = ConfigFactory::getConfig('cache');

		$this->cache_path = $this->path_base . $this->cache_config->paths['default'];

		$extension = $this->cache_config->cache_extension;

		if (!is_string($extension) || empty($extension))
			$this->cache_extension = '';
		else
			$this->cache_extension = '.' . $extension;
	}


	protected function isCacheFileValid(CacheFile $cache_file, $expire)
	{
		if (is_null($expire))
			$expire = $this->cache_config->default_expired_time;

		if ($expire !== false && ($expire === true || $this->isCacheFileExpired($cache_file, $expire)))
			return false;
		else
			return true;
	}


	protected function ensureCacheFolder()
	{
		if (!file_exists($this->cache_path))
			mkdir($this->cache_path, 0600, true);
	}


	/**
	 * @param CacheFile $cache_file
	 * @param int $sec_interval
	 * @return bool
	 */
	protected function isCacheFileExpired(CacheFile $cache_file, $sec_interval)
	{

		if (!is_int($sec_interval))
			return false;

		switch ($this->cache_config->mode) {
			case 'production' :
				return $cache_file->isExpired(new DateInterval('PT' . $sec_interval . 'S'));
				break;
			case 'all_expire' :
				return true;
				break;
			case 'no_expire':
				return false;
				break;
			default:
				return $cache_file->isExpired(new DateInterval('PT' . $sec_interval . 'S'));
		}

	}


	/**
	 * @param $filename string
	 * @return CacheFile
	 */
	protected function getFileCache($filename)
	{
		if (array_key_exists($filename, $this->files_cache))
			return $this->files_cache[ $filename ];

		$this->files_cache[ $filename ] = new CacheFile($this->cache_path . $filename);

		return $this->files_cache[ $filename ];
	}


	final private function __clone()
	{
	}
}