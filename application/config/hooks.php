<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['pre_controller'][] = [
	'class'    => 'CORSHook',
	'function' => 'perform',
	'filename' => 'CORSHook.php',
	'filepath' => 'hooks'
];

$hook['post_controller_constructor'][] = [
	'class'    => 'AuthorizationHook',
	'function' => 'perform',
	'filename' => 'AuthorizationHook.php',
	'filepath' => 'hooks'
];