<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=personal_blog","root", "1234");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Unable to connect to database: " . $e->getMessage());
}
?>
