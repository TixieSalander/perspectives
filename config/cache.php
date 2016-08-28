<?php
return [

	/*
	 * production   - Works normaly
	 * all_expire   - Data always expire
	 * no_expire    - Data never expire
	 *
	 * */

	'mode' => 'no_expire',


	/*
	 * Write down the folder to store
	 * the cache files
	 *
	 * */

	'paths' => [
		'default' => 'cache/',
//		'data'    => 'cache/',
//		'file'    => 'cache/',
		'url'     => 'img/cache/',
	],

	/*
	 * Write down the extension you want
	 * to use for the cache system
	 *
	 * */

	'cache_extension' => '',
//	'cache_extension' => 'cache',

	'default_expired_time' => 3600,


	/*
	 * Next features ?
	 * */

	'keyfile_name' => 'cache_keyfile',

	'if_expired' => false,

	'auto_expire_keys' => [],

];