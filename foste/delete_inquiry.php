<?php
session_start();
include("classes/bd.php");
include("classes/demmand_contact.php");
$connection = new Connection();
$conn = $connection->conn;
if ($conn == null) {
  echo "échec de connexion de base de données";
  exit();
}
if (isset($_GET['id'])) {
    $inquiry_id = $_GET['id'];
    Demmand_contact::deleteDemmand($conn, $inquiry_id);
    header("Location: adminpage.php");
    exit();
} else {
    header("Location: adminpage.php");
    exit();
}
?>
