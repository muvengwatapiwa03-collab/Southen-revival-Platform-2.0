<?php 
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: about.php");
    exit();
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership page</title>
    <link rel="stylesheet" href="aboutstyle.css">
</head>
<body style="background-color: #fff;">
    <div class="box">
    <h1>Welcome,<span><?= $_SESSION['name']; ?></span></h1>
    <p>This is a <span>Membership</span>page</p>
    <button onclick="window.location.href='logout.php'">Logout</button>
    </div>
</body>
</html>