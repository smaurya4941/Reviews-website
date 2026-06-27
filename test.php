<?php
$db = include 'application/config/database.php';
$conn = new mysqli($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);
$res = $conn->query("DESCRIBE websites");
while($row = $res->fetch_assoc()) echo $row['Field'] . "\n";
