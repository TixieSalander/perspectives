<?php


namespace App;


interface CacheInterface
{

	public function get($name);

	
	public function read($name);

	public function write($name, $value);

	public function save(CacheEntry $entry, $value);


	public function remove($name);

}