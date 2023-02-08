<?php
include 'database.php';

$id = $_GET["id"];

$sql = "DELETE FROM messages WHERE id = $id";

if (mysqli_query($mysqli, $sql)) {
  header("Location: backoffice-messages.php");
  exit;
}