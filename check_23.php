<?php
$mysqli = new mysqli('127.0.0.1', 'root', '', 'reviews', 3307);
$res = $mysqli->query("SELECT * FROM users WHERE id = 23");
$row = $res->fetch_assoc();
print_r($row);
