<?php
    include 'db_conn.php';

    session_start();

    if(!isset($_SESSION['sort_by'])) {
        $_SESSION['sort_by'] = $select_qry = "SELECT surf_name, surf_report FROM forecast WHERE surf_name IN (
            SELECT forecast_name FROM surf_gallery WHERE gallery_owner=:?) ORDER BY surf_name ASC";
    }
    $userid = $_SESSION['user_id'];
    $sortie = $conn->prepare($_SESSION['sort_by']);
    echo $_SESSION['sort_by'];
    $gallery = $sortie->execute(['$user_id'])->fetchAll();

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
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
    <p align="right"><a href="logout.php" class="btn btn-danger" style="margin-right: 20px">Logout</a></p>
    <div>
        <h1 class="text-center display-3" style="align-left">Surf Breaks</h1>
        <h2 class="text-center display-6" style="margin-top: -10px;font-size: 1.5rem">Welcome <b><?=$_SESSION['user_name']?></b>!</h2>
    </div>
    
    <div class="d-flex justify-content-center" style="min-height: 100vh;">
        <div class="p-5 rounded shadow">
            <!-- Gallery Insertion Error/Sucess message -->
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert"><?=$_GET['error']?></div>
            <?php } ?>
            <?php if (isset($_GET['success']) && $_GET['success'] !=="sorted") { ?>
                <div class="alert alert-info"><?php echo $_GET['success']; ?></div>
            <?php } ?>
            <!-- Gallery Insertion Form -->
            <form class="form-horizontal" action="addSurf.php" method="post" style="width: 60rem">
            <label for="surfList" class="form-label">List Of Surf Spots</label>
            <input class="form-control" list="datalistOptions" id="surfList" name="surfList" placeholder="Type to search..." style="width: 30rem">
                <datalist id="datalistOptions">
                    <?php
                        //get list of surf spots from database
                        $sql = "SELECT * FROM location";
                        $data = $conn->query($sql)->fetchAll();
                        foreach($data as $row) { echo "<option value=\"".$row['break']."\">"; }                    
                    ?>
                </datalist>
                <button type="submit" class="btn btn-primary float-right" name="search" style="margin-top: 10px">Add to Gallery</button>
            </form>
            <hr>
            <!-- Sort dropdown menu -->
            <div>
                <form class="form-horizontal" action="sortGallery.php" method="post" style="margin-bottom: 15px">
                    <select class="btn btn-warning dropdown-toggle shadow" type="submit" name="dropbox" id="dropbox" onchange="this.form.submit();">
                        <option value="Default" <?=$sortValue == 0 ? 'selected="selected"': ''; ?>>Sort By:</option>
                        <option value="A-Z" <?=$sortValue == 1 ? 'selected="selected"': ''; ?>>A-Z</option>
                        <option value="Z-A" <?=$sortValue == 2 ? 'selected="selected"': ''; ?>>Z-A</option>
                    </select>
                    <!-- <input class="btn btn-secondary" type="submit" value="Sort" id="dropbox" name="dropbox" style="margin-left: 5px"></input> -->
                    <input type="hidden" name="name" value="">
                    <input type="hidden" name="date" value="">
                </form>
            </div>
           


            <div class="gallery">
            </div>
        </div>
    </div>
</body>
</html>

<?php 
} else {
    header("Location: login.php");
}
?>