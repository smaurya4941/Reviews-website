<?php
$conn = new mysqli('127.0.0.1', 'root', '', 'reviews', 3307);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$uname = 'superadmin';
$password = password_hash('123456', PASSWORD_DEFAULT);
$form_key = md5(uniqid());

$sql = "INSERT INTO users (fname, lname, uname, password, email, mobile, sadmin, admin, sub, active, form_key) 
        VALUES ('Super', 'Admin', '$uname', '$password', 'admin@example.com', '1234567890', '1', '1', '1', '1', '$form_key')";

if ($conn->query($sql) === TRUE) {
    echo "Superadmin created successfully";
} else {
    echo "Error: " . $sql . "\n" . $conn->error;
}
$conn->close();
?>
