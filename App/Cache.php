<?php


namespace App;

use DateInterval;

class Cache implements CacheInterface
{


	private static $_instance;
	private $base_path = __DIR__ . '/../';
	private $cache_path;
	private $cache_config;
	private $cache_entries = [];


	/**
	 * Cache constructor
	 */
	private function __construct()
	{
		$this->cache_config = ConfigFactory::getConfig('cache');

		$this->cache_path = $this->base_path . $this->cache_config->cache_folder;

		if (!file_exists($this->cache_path)) {

			mkdir($this->cache_path, 0700);

		} else {

			$cache_files = glob($this->cache_path . '/*.' . $this->cache_config->cache_extension);

			foreach ($cache_files as $filepath) {

				$name = pathinfo($filepath, PATHINFO_FILENAME);
				$value = file_get_contents($filepath);
				$time = filemtime($filepath);

				$this->cache_entries[ $name ] = new CacheEntry($name, $value, '@' . $time);

			}

		}
	}


	static function getInstance()
	{
		if (empty(self::$_instance))
			self::$_instance = new Cache();

		return self::$_instance;
	}


	public function read($name, $sec_interval = 3600)
	{
		$entry = $this->get($name);

		if ($entry === null)
			return null;

		if ($this->isEntryValid($entry, $sec_interval))
			return $entry->getValue();

		return null;

	}


	public function get($name)
	{
		if (array_key_exists($name, $this->cache_entries))
			return $this->cache_entries[ $name ];

		return null;
	}


	public function isEntryValid(CacheEntry $entry, $sec_interval = 3600)
	{
		switch ($this->cache_config->mode) {
			case 'production' :
				return $entry->isValid(new DateInterval('PT' . $sec_interval . 'S'));
				break;
			case 'all_expire' :
				return false;
				break;
			case 'no_expire':
				return true;
				break;
			default:
				return $entry->isValid(new DateInterval('PT' . $sec_interval . 'S'));
		}

	}


	public function write($name, $value)
	{

		if ($entry = $this->get($name)) {

			return $this->save($entry, $value);

		} else {

			$this->cache_entries[ $name ] = $this->getAndStoreNewEntry($name, $value);

			return $this->save($this->get($name), $value);

		}


		return false;

	}


	public function save(CacheEntry $entry, $value)
	{

		$entry->setValue($value);
		$this->store($entry);

	}


	private function store(CacheEntry $entry)
	{
		file_put_contents($this->cache_path . '/' . $entry->getName() . '.' . $this->cache_config->cache_extension, $entry->value, LOCK_EX);

		if ($this->get($entry->getName()) === null)
			$this->cache_entries[ $entry->getName() ] = $entry;
	}


	private function getAndStoreNewEntry($name, $value = '')
	{
		$full_path = $this->base_path .
			$this->cache_config->cache_folder .
			"/$name." . $this->cache_config->cache_extension;

		file_put_contents($full_path, $value);

		return new CacheEntry($name, $value);

	}


	public function remove($name)
	{
		$entry = $this->get($name);

		if ($entry === null)
			return false;
		else
			$this->deleteEntry($entry);

	}


	private function deleteEntry(CacheEntry $entry)
	{
		unlink($this->cache_path . '/' . $entry->getName() . '.' . $this->cache_config->cache_extension);
		unset($this->cache_entries[ $entry->getName() ]);
	}

}