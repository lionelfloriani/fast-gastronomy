<?php
include 'database.php';

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  $_SESSION['logged_in'] = false;
  header('Location: backoffice-login.php');
  exit;
}

$query_logo = "SELECT img FROM logo_img";
$result_logo = mysqli_query($mysqli, $query_logo);

$images_logo = array();

while ($row = mysqli_fetch_assoc($result_logo)) {
    $images_logo[] = $row['img'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Quai</title>
</head>
<body>
    <section class="flex flex-col items-center justify-center">
      <img src="data:image/jpeg;base64,<?php echo base64_encode($images_logo[1]); ?>" alt="Logo" class="mt-28 w-3/12" />
      <h3 class="text-md md:text-lg font-medium pt-5">Dashboard - Back Office</h3>
    </section>
    <section class="flex items-center justify-center gap-20 mt-40">
      <a href="backoffice-messages.php">
        <div class="bg-black text-white rounded shadow p-6 flex flex-col items-center gap-2 w-64">
          <span class="material-symbols-outlined">
            mail
          </span>
          <h2 class="text-lg mb-2">MESSAGES</h2>
        </div>
      </a>
      <a href="backoffice-photos.php">
        <div class="bg-black text-white rounded shadow p-6 flex flex-col items-center gap-2 w-64">
          <span class="material-symbols-outlined">
            photo_camera
          </span>
          <h2 class="text-lg mb-2">PHOTOS</h2>
        </div>
      </a>
      <a href="backoffice-logout.php">
        <div class="bg-black text-white rounded shadow p-6 flex flex-col items-center gap-2 w-64">
          <span class="material-symbols-outlined">
            logout
          </span>
          <h2 class="text-lg mb-2">LOG OUT</h2>
        </div>
      </a>
    </section>
  </body>
</html>