<?php
session_start();
include 'db_conn.php';

if (isset($_POST['login'])) {
    
    $username = $_POST['username1'];
    $password = $_POST['password1'];

    if (empty($username)) {
        header("Location: login.php?error=Email is required");
    } else if (empty($password)) {
        header("Location: login.php?error=Password is required to login.");
    } else {
        $stmt = $conn->prepare("SELECT * FROM user WHERE userName=?");
        $stmt->execute([$username]);

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch();

            $user_id = $user['userID'];
            $user_name = $user['userName'];
            $user_password = $user['password'];

            if($username === $user_name) {
                if($password === $user_password) {
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_name'] = $user_name;
                    header("Location: index.php");
                } else {
                    header("Location: login.php?error=Incorrect username or password");
                }
            }
        } else {
            header("Location: login.php?error=Incorrect username or password");
        }
    }
}

if (isset($_POST['register'])) {
    
    $username = $_POST['username1'];
    $password = $_POST['password1'];
    $password2 = $_POST['password2'];

    if (empty($username)) {
        header("Location: login.php?error=Email is required to register");
    } else if (empty($password)) {
        header("Location: login.php?error=Password is required to register");
    } else if (empty($password2)) {
        header("Location: login.php?error=Confirm password to register");
    } else {
        $stmt = $conn->prepare("SELECT * FROM user WHERE userName=?");
        $stmt->execute([$username]);
        
        if ($stmt->rowCount() !== 0) { 
            header("Location: login.php?error=User exists already");

        } else {
            
        }
    }
}
?>