<?php
require __DIR__ . '/../db.php';

function checkLogin($db){
    // Foydalanuvchi login qilganligini tekshirish
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }
}