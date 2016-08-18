<?php


namespace App;


class ConfigFactory
{

	static protected $_instance;
	private $configs = [];


	private function __construct()
	{

	}


	/**
	 * @param $name string
	 * @return Config
	 */
	static function getConfig($name)
	{
		return self::getInstance()->fetchConfig($name);
	}


	/**
	 * @param $name string
	 * @return Config
	 */
	public function fetchConfig($name)
	{
		if (array_key_exists($name, $this->configs)) {

			return $this->configs[ $name ];

		} else {

			$this->configs[ $name ] = new Config($name);

			return $this->configs[ $name ];

		}
	}


	static function getInstance()
	{
		if (empty(self::$_instance))
			self::$_instance = new ConfigFactory();

		return self::$_instance;
	}

}