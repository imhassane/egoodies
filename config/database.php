<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	// 'hostname' => 'localhost:3307',
	// 'username' => 'root',
	// 'password' => '',
	// 'database' => 'shop',
	'hostname' => 'obiwan2.univ-brest.fr',
	'username' => 'zsowth000',
	'password' => 'egs3wqii',
	'database' => 'zal3-zsowth000',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
