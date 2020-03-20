<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'hostname' => 'localhost', // Your database connection address (can be an IP or hostname)
    /*'username' => 'uzjaiws', // The username to login with
    'password' => 'Vd&32o2o', // The password to login with
    'database' => 'yonzi_ajfaksldb', // The name of the database
	*/
	'username' => 'root', // The username to login with
    'password' => 'root', // The password to login with
    'database' => 'sendxo', // The name of the database

    /*
  !!! Do not edit anything below without knowing what you're doing !!!
    */
    'dbdriver' => 'mysqli',
    'dsn'	   => '',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt'  => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
