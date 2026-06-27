<?php
$_SERVER['REQUEST_METHOD'] = 'POST';
$_POST['uname'] = 'sachin';
$_POST['pwd'] = 'password';

define('ENVIRONMENT', 'development');
$_SERVER['SERVER_ADDR'] = '127.0.0.1';
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
$_SERVER['REQUEST_URI'] = '/login';
require 'd:\bizorm\index.php';
