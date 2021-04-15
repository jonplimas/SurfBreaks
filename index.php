<?php
    include 'db_conn.php';

    


    session_start();
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
        // Gallery 
        $qry = "SELECT * FROM gallery WHERE gallery_owner=?";
        $gallery = $conn->query($qry)->fetchAll();
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SURF BREAKS ~Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <br>
    <p align="right"><a href="logout.php" class="btn btn-danger">Logout</a></p>
    <div>
        <h1 class="text-center display-3" style="align-left">Surf Breaks</h1>
        <h2 class="text-center display-6" style="margin-top: -10px;font-size: 1.5rem">Welcome <b><?=$_SESSION['user_name']?></b>!</h2>
    </div>
    
    <div class="d-flex justify-content-center" style="min-height: 100vh;">
        <div class="p-5 rounded shadow">
            <form class="form-horizontal" action="index.php" method="post" style="width: 60rem">
            <label for="surfList" class="form-label">List Of Surf Spots</label>
            <input class="form-control" list="datalistOptions" id="surfList" placeholder="Type to search..." style="width: 30rem">
                <datalist id="datalistOptions">
                    <?php
                        //get list of surf spots from database
                        $sql = "SELECT * FROM location";
                        $data = $conn->query($sql)->fetchAll();
                        foreach($data as $row) { echo "<option value=\"".$row['break']."\">"; }                    
                    ?>
                </datalist>
                <button type="submit" class="btn btn-primary float-right" name="add">Add to Gallery</button>
            </form>
<<<<<<< Updated upstream
=======
            <hr>
            <div class="gallery">
                <div class="gallery_row">
                <?php
                    $counter = 0;



                    foreach($gallery as $row) {
                        // echo $row[''];
                    }
                
                ?>
                </div>





            </div>
>>>>>>> Stashed changes
        </div>
    </div>
</body>
</html>

<?php 
} else {
    header("Location: login.php");
}
?>