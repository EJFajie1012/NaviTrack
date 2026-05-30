<?php
session_start();
include "db_connection.php";
global $conn;

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$sql = "
SELECT users.*, role.role_name
FROM users
JOIN role
ON users.role_id = role.role_id
WHERE users.username = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Prepare failed: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "s", $username);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role_name'];

        if ($row['role_name'] == 'ADMIN') {
            header("Location: /Sys_Admin/index.php");
            exit();
        } elseif ($row['role_name'] == 'TEACHER') {
            header("Location: /Sys_Teacher/index.php");
            exit();

        } elseif ($row['role_name'] == 'STUDENT') {
            header("Location: /Sys_User/index.php");
            exit();
        } else {
            echo "Unknown role.";
        }
    } else {
        echo "Invalid password.";
    }
} else {
    echo "User not found.";

}
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>