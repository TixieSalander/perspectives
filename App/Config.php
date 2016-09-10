<?php


namespace App;


class Config
{

	protected $name = '';
	protected $configs = [];
	static protected $_instance;


	/**
	 * Config constructor.
	 *
	 * @param $filename string
	 * @throws \Exception
	 */
	public function __construct($filename)
	{
		$this->name = $filename;
		$path = __DIR__ . '/../config/' . $filename . '.php';

		if (file_exists($path)) {
			$configs = include $path;
			$this->configs = $configs;
		} else {
			throw new \Exception('This configuration doesn\'t exist. Path: ' . $path);
			return false;
		}
	}


	public function __get($name)
	{
		if (array_key_exists($name, $this->configs))
			return $this->configs[ $name ];
		else
			throw new \Exception('Configuration not found in ' . $this->name);
	}

}