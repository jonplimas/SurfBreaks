<?php
session_start();
include 'db_conn.php';

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

            $sql2 = "INSERT INTO gallery (id, forecast_name) VALUES (:bID, :bName)";
            $result3 = $conn->prepare($sql2)->execute([
                'bID'=> $_SESSION['id'],
                'bName'=> $name
            ]);
            header("Location: index.php?success=$name sucessfully added");
            echo $name;
            

            // $result3->execute([
            //     'bID' => $_SESSION['user_id'],
            //     'bName' => $name
            // ])
            $_SESSION['gallery_insert'] = $name;
            
        }
    }
    
    
}

?>