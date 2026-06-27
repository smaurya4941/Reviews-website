<?php
$db = new mysqli('127.0.0.1', 'root', '', 'reviews', 3307);
if ($db->connect_error) die('Connection failed');
$db->query("ALTER TABLE plan_requests ADD COLUMN payment_method VARCHAR(50) AFTER amount;");
echo $db->error;
echo "Done";
