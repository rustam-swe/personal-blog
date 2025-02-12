
<?php
require "credentials.php";
try {
    $db = new PDO("mysql:host=$dblocalhost;dbname=$dbname" ,$dbroot, $dbpassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Unable to connect to database: " . $e->getMessage());
}
?>
