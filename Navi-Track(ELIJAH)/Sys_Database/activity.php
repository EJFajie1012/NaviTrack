<?php
include "db_connection.php";
global $conn;

if (isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE users SET last_activity = NOW() WHERE user_id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
}
?>