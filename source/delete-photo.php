<?php
include 'database.php';

$id = $_GET["id"];

$sql = "DELETE FROM photos WHERE id = $id";

if (mysqli_query($mysqli, $sql)) {
  header("Location: backoffice-photos.php");
  exit;
}