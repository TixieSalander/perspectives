<?php


namespace App\Cache;


interface CacheInterface
{
	
	public function read($name, $expire = null);

	public function write($name, $value = null);

	public function remove($name);
	
}