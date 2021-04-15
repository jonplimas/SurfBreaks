<?php
session_start();
include 'db_conn.php';

$userid = $_SESSION['user_id'];

if (isset($_POST['search'])) {

    $beach_name = trim($_POST['surfList']);

    if(empty($beach_name)) {
        header("Location: index.php?error=search field must not be empty");
    } else {
        $stmt = $conn->prepare("SELECT * FROM location WHERE break=?");
        $stmt->execute([$beach_name]);
    
        if($stmt->rowCount()!== 1) {
            header("Location: index.php?error=location does not exist");
        } else {
            $surf = $stmt->fetch();
            $name = $surf['break'];

            $sql = 'INSERT INTO surf_gallery (gallery_owner, forecast_name) VALUES (:mName, :mPassword)';
                $result2 = $conn->prepare($sql);
                $result2->execute([
                    'mName' => $userid,
                    'mPassword' => $name
                ]);
            $_SESSION['gallery_insert'] = $name;
            header("Location: index.php?success=$name successfully added");
        }
    }
}

?>