<?php
return [

	/*
	 * production   - Works normaly
	 * all_expire   - Data always expire
	 * no_expire    - Data never expire
	 *
	 * */

	'mode' => 'production',


	/*
	 * Write down the folder to store
	 * the cache files
	 *
	 * */

	'paths' => [
		'default' => 'cache/',
		'data'    => 'cache/',
		'url'     => 'cache/img/',
	],

	/*
	 * Write down the extension you want
	 * to use for the cache system
	 *
	 * */

	'cache_extension' => '',

	'default_expired_time' => 3600,

	'default_chmod' => 0700,

	/*
	 * Next features ?
	 * */

	'keyfile_name' => 'cache_keyfile',

	'if_expired' => false,

	'auto_expire_keys' => [],

];
