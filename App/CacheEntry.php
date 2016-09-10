<?php


namespace App;


use DateInterval;
use DateTime;

class CacheEntry
{

	public $value;
	private $name;
	private $date;
	private $expire_interval;


	public function __construct($name, $value = '', $filetime = 'now', $expiration_time = 3600)
	{
		$this->name = $name;
		$this->date = new DateTime($filetime);
		$this->value = $value;
		$this->expire_interval = new DateInterval('PT' . $expiration_time . 'S');

	}


	public function getDate($object = false)
	{
		if ($object)
			return $this->date;
		else
			return $this->date->format('r');
	}


	public function getName()
	{
		return $this->name;
	}


	public function getValue()
	{
		return $this->value;
	}


	public function setValue($value)
	{
		$this->value = $value;

		return $this;
	}


	public function isValid(DateInterval $interval)
	{
		$expire_date = clone $this->date;
		$expire_date->add($interval);

		return $expire_date->diff(new DateTime())->invert === 1;
	}

}