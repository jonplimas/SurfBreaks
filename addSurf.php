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
    
        if($stmt->rowCount() === 0) {
            header("Location: index.php?error=location does not exist");
        } else {
            $check = $conn->prepare("SELECT * FROM surf_gallery WHERE gallery_owner=:gown AND forecast_name=:fname");
            $check->execute([
                'gown' => $userid,
                'fname' => $beach_name
            ]);

            if($check->rowCount() >= 1) {
                header("Location: index.php?error=$beach_name is already in your gallery"); 
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
}

?>