<?php
include 'database.php';

session_start();

$query_logo = "SELECT img FROM logo_img";
$result_logo = mysqli_query($mysqli, $query_logo);

$images_logo = array();

while ($row = mysqli_fetch_assoc($result_logo)) {
    $images_logo[] = $row['img'];
}

$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST"){
  $username = $mysqli->real_escape_string($_POST["username"]);
  $sql = "SELECT * FROM login_backoffice WHERE username = '$username'";
  $result = $mysqli->query($sql);
  if (!$result) {
      die($mysqli->error);
  }
  // if ($result->num_rows === 0) {
  //     echo "No user found with the username: $username";
  //     exit;
  // }
  $user = $result->fetch_assoc();
  if ($user){
    if ($_POST["password"] === $user["password"]){
      $_SESSION["logged_in"] = true;
      header("Location: backoffice.php");
      exit;
    }
  }
  $is_invalid = true;
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
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>Quai</title>
  </head>
  <body>
    <section id="hero" class="flex flex-col items-center justify-center">
      <img src="data:image/jpeg;base64,<?php echo base64_encode($images_logo[1]); ?>" alt="Logo" class="mt-28 w-3/12" />
      <h3 class="text-md md:text-lg font-medium pt-5">We do it faster & we do it better.</h3>
      <em class="mt-8">
      <?php if ($is_invalid): ?>
        <div class="bg-red-100 p-5 w-48 rounded mb-4">
          <div class="flex space-x-3 items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="flex-none fill-current text-red-500 h-4 w-4">
              <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.597 17.954l-4.591-4.55-4.555 4.596-1.405-1.405 4.547-4.592-4.593-4.552 1.405-1.405 4.588 4.543 4.545-4.589 1.416 1.403-4.546 4.587 4.592 4.548-1.403 1.416z" />
            </svg>
            <div class="leading-tight flex flex-col space-y-2">
              <div class="text-sm font-medium text-red-700">Invalid login</div>
            </div>
          </div>
        </div> 
      <?php endif; ?>
      <?php
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] !== true && ($is_invalid === false)) {
?>
    <div class="bg-red-100 p-5 w-48 rounded mb-4">
      <div class="flex space-x-3 items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="flex-none fill-current text-red-500 h-4 w-4">
          <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.597 17.954l-4.591-4.55-4.555 4.596-1.405-1.405 4.547-4.592-4.593-4.552 1.405-1.405 4.588 4.543 4.545-4.589 1.416 1.403-4.546 4.587 4.592 4.548-1.403 1.416z" />
        </svg>
        <div class="leading-tight flex flex-col space-y-2">
          <div class="text-sm font-medium text-red-700">Access denied</div>
        </div>
      </div>
    </div>
<?php
} elseif ($is_invalid === false) {
?>
<div class="bg-white p-5 w-48 rounded mb-4">
      <div class="flex items-center justify-center">
        <div class="flex flex-col">
          <div class="text-sm text-black">Back office</div>
        </div>
      </div>
    </div>
    <!-- Your content for non-logged in users here -->
<?php
}
?>
      </em>
      <form class="bg-white rounded shadow p-6 flex flex-col sm:w-2/3" method="post">
      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2" for="username">Username</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="" name="username">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2" for="password">Password</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="" name="password">
      </div>
        <button class="bg-black text-white p-2 rounded">Log in</button>
      </form>
      <button class="mt-8 bg-black text-white py-2 px-4 rounded"><a href="index.php">Home</a></button>
    </section>
  </body>
</html>