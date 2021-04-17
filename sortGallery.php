<?php
session_start();
include 'db_conn.php';

if (isset($_POST['dropbox'])) {
    echo 'Sort Gallery';
    echo '<br>';
    $selectedDropbox = trim($_POST['dropbox']);

    echo $selectedDropbox;
    echo '<br>';


    $select_qry = "SELECT surf_name, surf_report FROM forecast WHERE surf_name IN (
        SELECT forecast_name FROM surf_gallery WHERE gallery_owner=?) ORDER BY surf_name ASC";
    if($selectedDropbox != "") {
        switch ($selectedDropbox) {
            case 'Default':
                $select_qry = "SELECT surf_name, surf_report FROM forecast WHERE surf_name IN (
                    SELECT forecast_name FROM surf_gallery WHERE gallery_owner=?) ORDER BY surf_name ASC";
                break;
            case 'A-Z':
                $select_qry = "SELECT surf_name, surf_report FROM forecast WHERE surf_name IN (
                    SELECT forecast_name FROM surf_gallery WHERE gallery_owner=?) ORDER BY surf_name ASC";
                break;
            case 'Z-A':
                $select_qry = "SELECT surf_name, surf_report FROM forecast WHERE surf_name IN (
                    SELECT forecast_name FROM surf_gallery WHERE gallery_owner=?) ORDER BY surf_name DESC";
                break;
        }
    }

    echo $select_qry;

    $_SESSION['sort_by'] = $select_qry;
    header("Location: index.php?success=sorted");





}

// "SELECT surf_report FROM forecast WHERE surf_name IN (SELECT forcast_name FROM surf_gallery WHERE gallery_owner=10)"


?>