<?php
$db = new mysqli('127.0.0.1', 'root', '', 'reviews', 3307);
if ($db->connect_error) die('Connection failed');
$db->query("CREATE TABLE IF NOT EXISTS plan_requests (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    user_id INT, 
    form_key VARCHAR(255), 
    plan_id INT, 
    amount DECIMAL(10,2), 
    status VARCHAR(20) DEFAULT 'pending', 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");
echo $db->error;
echo "Done";
