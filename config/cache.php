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

	'cache_folder' => 'cache',

	/*
	 * Write down the extension you want
	 * to use for the cache system
	 *
	 * */

	'cache_extension' => 'cache',


	/*
	 * Next features ?
	 * */

	'keyfile_name' => 'cache_keyfile',

	'if_expired' => false,

	'auto_expire_keys' => [],

];