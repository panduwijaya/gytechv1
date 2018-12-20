<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['daftar'] = 'Daftar';

$route['default_controller'] = 'welcome';
$route['prosescart'] = 'Cart/add_to_cart';
$route['showcart'] = 'Cart/show_cart';
$route['loadcart'] = 'Cart/load_cart';
$route['deletecart'] = 'Cart/hapus_cart';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['(:any)'] = 'welcome/$1';