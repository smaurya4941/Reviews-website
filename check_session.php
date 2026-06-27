<?php
define('ENVIRONMENT', 'development');
$_SERVER['SERVER_ADDR'] = '127.0.0.1';
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
$_SERVER['REQUEST_URI'] = '/';
require 'd:\bizorm\index.php';
$CI =& get_instance();
$CI->load->library('session');
echo "SESSION mr_id: " . $CI->session->userdata('mr_id') . "\n";
echo "SESSION logged_in: " . $CI->session->userdata('mr_logged_in') . "\n";
