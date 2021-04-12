<?php
if (isset($_POST['username1']) && isset($_POST['password1'])) {
    
    $username = trim($_POST['username1']);
    $password = trim($_POST['password1']);

    if (empty($email)) {
        header("Location: login.php?error=Email is required");
    } else if (empty($password)) {
        header("Location: login.php?error=Password is required");
    } else {
        echo "Good!";
    }
}
?>