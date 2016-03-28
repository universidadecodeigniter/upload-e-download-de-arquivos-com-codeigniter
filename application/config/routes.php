<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Base';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['upload'] = 'Base/Upload';
$route['download/(:any)/(:any)'] = 'Base/Download/$1/$2';
