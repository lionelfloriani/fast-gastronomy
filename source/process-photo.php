<?php
include 'database.php';

// process form
if (isset($_POST['upload'])) {
  $fileName = mysqli_real_escape_string($mysqli, $_POST['fileName']);
  $photo = $_FILES['photo']['tmp_name'];
  
  // Validate the uploaded file
  if (!is_uploaded_file($photo)) {
    echo 'Error: The file was not uploaded properly.';
    exit;
  }
  
  $photoData = file_get_contents($photo);
  
  $sql = "INSERT INTO photos (picName, photo) VALUES (?, ?)";
  $stmt = mysqli_prepare($mysqli, $sql);
  
  // Bind the parameters
  mysqli_stmt_bind_param($stmt, 'ss', $fileName, $photoData);
  
  if (mysqli_stmt_execute($stmt)) {
    header("Location: backoffice-photos.php");
    exit;
  } else {
    echo "Error: Failed to insert data into the database: " . mysqli_error($mysqli);
  }
  
  mysqli_stmt_close($stmt);
}
?>