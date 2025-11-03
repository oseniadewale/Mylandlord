<?php
session_start();
require_once "classes/Db.php"; // your DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);
    $force_upgrade = isset($_POST['force_upgrade']) ? 1 : 0;

    $db = new Db();
    $pdo = $db->connect();

    $stmt = $pdo->prepare("UPDATE tenant SET force_upgrade = ? WHERE id = ?");
    $stmt->execute([$force_upgrade, $user_id]);

    $_SESSION['success'] = "Force upgrade setting updated successfully.";
    header("Location: manage_users.php");
    exit();
}
