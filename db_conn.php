<?php
$document_root = $_SERVER['CONTEXT_DOCUMENT_ROOT'];
$document_root = $document_root."/Project/";

// connect to mySQL db
$db_host = 'mariadb';
$db_user = 'cs431s29';
$db_password = 'Fee1vae2';
$db_name = 'cs431s29';

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed : ". $e->getMessage();
}
?>