<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  $_SESSION['logged_in'] = false;
  header('Location: backoffice-login.php');
  exit;
}

include 'database.php';

$query_photos = "SELECT * FROM photos";
$result_photos = mysqli_query($mysqli, $query_photos);

$photos = array();

while ($row = mysqli_fetch_assoc($result_photos)) {
  $photos[] = $row;
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
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Quai</title>
</head>
<body>
<div class="flex">
<div class="w-1/5 bg-black h-screen p-4 flex flex-col text-white sticky top-0 z-10">
      <img src="data:image/jpeg;base64,<?php echo base64_encode($images_logo[0]); ?>" alt="Logo" class="mt-4 w-3/4 md:w-2/4 self-center" />
    <a href="backoffice.php">
      <div class="font-bold mb-4 flex gap-1 mt-10 self-start pl-10"><span class="material-symbols-outlined">
        space_dashboard
        </span><p>Dashboard</p>
      </div>
    </a>
    <div class="mb-2 pl-10">
      <a href="backoffice-messages.php" class="hover:text-slate-600">
        Messages
      </a>
    </div>
    <div class="mb-2 pl-10 text-slate-400">
      <a href="backoffice-photos.php">
      Photos
      </a>
    </div>
    <div class="mb-2 mt-auto mb-10 flex self-center">
      <button class="bg-white text-black py-2 px-4 rounded self-center"><a href="index.php">Home</a></button>
    </div>
  </div>
  <div class="container mx-auto px-4 sm:px-8">
  <div class="py-8 border-b-4 border-black sticky top-0 z-10 bg-white">
    <div>
      <h2 class="text-2xl font-semibold leading-tight">Photos</h2>
    </div>
    <section class="py-10 px-8 md:px-20 bg-white">
    <div class="bg-white p-3 rounded-xl w-80">
    <form method="post" enctype="multipart/form-data" class="flex gap-10 items-center" action="process-photo.php">
  <div>
    <label for="photo" class="block mb-2">Upload a picture :</label>
    <input type="file" id="photo" name="photo" class="border p-1">
  </div>
  <div>
    <label for="fileName" class="block mb-2">Enter a name :</label>
    <input type="text" id="fileName" name="fileName" class="border p-2">
  </div>
  <div class="self-end">
    <input type="submit" value="Upload" name="upload" class="border px-3 py-1 bg-black text-white text-lg rounded mb-1">
  </div>
</form>
</div>

    </section>
  </div>
  <div class="container mx-auto">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-1">
        <?php $photos = array_reverse($photos); ?>
        <?php foreach ($photos as $photo) { ?>
          <div class="bg-white rounded shadow p-6 flex flex-col items-center">
          <img src="data:image/jpeg;base64,<?php echo base64_encode($photo['photo']); ?>" alt="" class="img-size mb-6">
          <h2 class="text-lg mb-2">
            <?php echo $photo['picName']; ?>
          </h2>
          <a href="delete-photo.php?id=<?php echo $photo['id']; ?>">
                  <span class="material-symbols-outlined">
                    delete
                  </span>
                </a>
                </div>
          <?php } ?>
      </div>
    </div>
  </body>
</html>