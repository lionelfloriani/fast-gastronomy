<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  $_SESSION['logged_in'] = false;
  header('Location: backoffice-login.php');
  exit;
}

include 'database.php';

$query_logo = "SELECT img FROM logo_img";
$result_logo = mysqli_query($mysqli, $query_logo);

$images_logo = array();

while ($row = mysqli_fetch_assoc($result_logo)) {
    $images_logo[] = $row['img'];
}

$query_messages = "SELECT * FROM messages";
$result_messages = mysqli_query($mysqli, $query_messages);

$messages = array();

while ($row = mysqli_fetch_assoc($result_messages)) {
    $messages[] = $row;
}

foreach ($messages as &$innerArray) {
  $innerArray['date'] = date("H:i d/m/Y", strtotime($innerArray['date']));
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
<div class="flex">
  <div class="w-1/5 bg-black h-screen p-4 flex flex-col text-white sticky top-0 z-10 ">
      <img src="data:image/jpeg;base64,<?php echo base64_encode($images_logo[0]); ?>" alt="Logo" class="mt-4 w-3/4 md:w-2/4 self-center" />
    <a href="backoffice.php">
      <div class="font-bold mb-4 flex gap-1 mt-10 self-start pl-10"><span class="material-symbols-outlined">
        space_dashboard
        </span><p>Dashboard</p>
      </div>
    </a>
    <div class="mb-2 pl-10 text-slate-400">
      <a href="backoffice-messages.php">
        Messages
      </a>
    </div>
    <div class="mb-2 pl-10">
      <a href="backoffice-photos.php" class="hover:text-slate-600">
      Photos
      </a>
    </div>
    <div class="mb-2 mt-auto mb-10 flex self-center">
      <button class="bg-white text-black py-2 px-4 rounded self-center"><a href="index.php">Home</a></button>
    </div>
  </div>

  <div class="container mx-auto px-4 sm:px-8">
  <div class="py-8">
    <div>
      <h2 class="text-2xl font-semibold leading-tight">Messages</h2>
    </div>
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
      <div
        class="inline-block min-w-full shadow-md rounded-lg overflow-hidden"
      >
        <table class="min-w-full leading-normal">
          <thead>
            <tr>
              <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-black text-left text-xs font-semibold text-white uppercase tracking-wider w-fit"
              >
                Name
              </th>
              <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-black text-left text-xs font-semibold text-white uppercase tracking-wider w-fit"
              >
                Email
              </th>
              <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-black text-left text-xs font-semibold text-white uppercase tracking-wider w-fit"
              >
                Subject
              </th>
              <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-black text-left text-xs font-semibold text-white uppercase tracking-wider w-fit"
              >
                Date
              </th>
              <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-black text-left text-xs font-semibold text-white uppercase tracking-wider w-fit"
              >
                Message
              </th>
              <th
                class="px-3 py-3 border-b-2 border-gray-200 bg-black text-left text-xs font-semibold text-white uppercase tracking-wider w-fit"
              >
              <span class="material-symbols-outlined">
                delete
              </span>
              </th>
          </thead>
          <?php foreach ($messages as $message) { ?>
          <tbody>
            <tr>
              <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                <div class="flex">
                  <div class="ml-3">
                    <p class="text-gray-900 whitespace-no-wrap">
                      <?php echo $message['firstname'] . " " . $message['lastname']; ?>
                    </p>
                  </div>
                </div>
              </td>
              <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap"><?php echo $message['email']; ?></p>
              </td>
              <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap"><?php echo $message['subject']; ?></p>
              </td>
              <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
              <p class="text-gray-900 whitespace-no-wrap"><?php echo $message['date']; ?></p>
              </td>
              <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
              <p class="text-gray-900 whitespace-no-wrap"><?php echo $message['message']; ?></p>
              </td>
              <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                <a href="delete-message.php?id=<?php echo $message['id']; ?>">
                  <span class="material-symbols-outlined">
                    delete
                  </span>
                </a>
              </td>
            </tr>
          </tbody>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</body>
</html>