<?php
include 'database.php';

// retrieve menu images

$query_menu = "SELECT img FROM menu_img";
$result_menu = mysqli_query($mysqli, $query_menu);

$images_menu = array();

while ($row = mysqli_fetch_assoc($result_menu)) {
    $images_menu[] = $row['img'];
}

// retrieve logo images

$query_logo = "SELECT img FROM logo_img";
$result_logo = mysqli_query($mysqli, $query_logo);

$images_logo = array();

while ($row = mysqli_fetch_assoc($result_logo)) {
    $images_logo[] = $row['img'];
}

// process form

$date = date("Y-m-d H:i:s");
$sql = "INSERT INTO messages (date, firstname, lastname, email, subject, message) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)){
  die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssssss", $date, $_POST["first-name"], $_POST["last-name"], $_POST["email"], $_POST["subject"], $_POST["message"]);

if ($stmt->execute()){
  header("Location: #contact");
  exit;
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
    <script>
      tailwind.config = {
      theme: {
        extend: {
          keyframes: {
            'open-menu': {
            '0%': { transform: 'scaleY(0)' },
            '80%': { transform: 'scaleY(1)' },
            '100%': { transform: 'scaleY(1)' },
            },
          },
          animation: {
            'open-menu': 'open-menu 0.5s ease-in-out forwards',
          }
        }
      }
    }
    </script>
    <header class="sticky top-0 z-10 text-white bg-black">
      <section class="mx-auto flex max-w-4xl items-center justify-between p-4">
        <h1 class="text-3xl font-medium">
          <a href="#hero"><img src="data:image/jpeg;base64,<?php echo base64_encode($images_logo[0]); ?>" alt="" class="w-20"></a>
        </h1>
        <div>
          <button
            id="hamburger-button"
            class="relative h-8 w-8 cursor-pointer text-3xl md:hidden"
          >
            <!-- &#9776; -->
            <div
              class="absolute top-4 -mt-0.5 h-1 w-8 rounded bg-white transition-all duration-500 before:absolute before:h-1 before:w-8 before:-translate-x-4 before:-translate-y-3 before:rounded before:bg-white before:transition-all before:duration-500 before:content-[''] after:absolute after:h-1 after:w-8 after:-translate-x-4 after:translate-y-3 after:rounded after:bg-white after:transition-all after:duration-500 after:content-['']"
            ></div>
          </button>
          <nav class="hidden space-x-8 md:block" aria-label="main">
            <a href="#concept" class="hover:opacity-90">Our Concept</a>
            <a href="#menu" class="hover:opacity-90">Menu</a>
            <a href="#info" class="hover:opacity-90">Info</a>
            <a href="#contact" class="hover:opacity-90">Contact</a>
          </nav>
        </div>
      </section>
      <section
        id="mobile-menu"
        class="top-68 justify-content-center absolute hidden w-full h-fit origin-top animate-open-menu flex-col bg-black text-xl text-white"
      >
        <!-- <button class="text-8xl self-end px-6">
                &times;
            </button> -->
        <nav
          class="flex min-h-screen flex-col items-center py-8"
          aria-label="mobile"
        >
          <a href="#hero" class="w-full py-6 text-center hover:opacity-90"
            >Home</a
          >
          <a href="#concept" class="w-full py-6 text-center hover:opacity-90"
            >Our Concept</a
          >
          <a
            href="#menu"
            class="w-full py-6 text-center hover:opacity-90"
            >Menu</a
          >
          <a href="#info" class="w-full py-6 text-center hover:opacity-90"
            >Info</a
          >
          <a href="#contact" class="w-full py-6 text-center hover:opacity-90"
            >Contact</a
          >
        </nav>
      </section>
    </header>
    <section id="hero" class="flex flex-col items-center justify-center">
    <img src="data:image/jpeg;base64,<?php echo base64_encode($images_logo[1]); ?>" alt="Logo" class="mt-44 w-3/4 md:w-2/4" />
    <a href="backoffice-login.php">
    <h3 class="text-md md:text-lg font-medium pt-5">We do it faster & we do it better.</h3>
    </a>
    </section>
    <section id="concept" class="bg-black py-20 mt-44">
      <h2 class="text-3xl font-bold text-center text-white">Our Concept</h2>
      <p class="text-md font-small text-left p-10 md:px-20 text-white">At our fast-food restaurant, we're challenging the status quo of traditional fast-food fare. Our concept combines the speed and convenience of a fast-food establishment with the elevated, gourmet flavors you'd expect from a fine dining experience.<span class="block text-start pt-4">We believe that fast food doesn't have to mean sacrificing quality or taste. That's why we source the freshest ingredients and use innovative cooking techniques to bring you an unforgettable gastronomic experience in a quick and casual setting.<br></span><span class="py-4 block">Come visit us and taste the difference for yourself!</span></p>
    </section>
    <section class="py-20 px-8 md:px-20 bg-white" id="menu">
    <div class="container mx-auto">
      <h1 class="text-black text-center text-4xl mb-6">Menu</h1>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-white rounded shadow p-6 flex flex-col items-center">
          <img src="data:image/jpeg;base64,<?php echo base64_encode($images_menu[1]); ?>" alt="Menu item" class="img-size mb-6">
          <h2 class="text-lg mb-2">Gourmet Burger</h2>
          <p class="text-gray-700 mb-2">A juicy, flame-grilled beef patty topped with melted cheddar cheese, crispy bacon, avocado, lettuce, tomato, and a tangy aioli sauce. Served on a brioche bun.</p>
          <p class="text-gray-700 mb-2 text-end w-full flex-grow"></p>
          <p class="text-gray-700 mb-2 text-end">$8.99</p>
        </div>
        <div class="bg-white rounded shadow p-6 flex flex-col items-center">
          <img src="data:image/jpeg;base64,<?php echo base64_encode($images_menu[5]); ?>" alt="Menu item" class="img-size mb-6">
          <h2 class="text-lg mb-2">Truffle Fries</h2>
          <p class="text-gray-700 mb-2">Crispy french fries tossed in truffle oil and parmesan cheese. Served with a side of garlic aioli.</p>
          <p class="text-gray-700 mb-2 text-end w-full flex-grow"></p>
          <p class="text-gray-700 mb-2 text-end">$5.99</p>
        </div>
        <div class="bg-white rounded shadow p-6 flex flex-col items-center">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($images_menu[0]); ?>" alt="Menu item" class="img-size mb-6">
          <h2 class="text-lg mb-2">Crispy Chicken Sandwich</h2>
          <p class="text-gray-700 mb-2">Buttermilk-marinated chicken breast, breaded and fried to crispy perfection. Topped with lettuce, tomato, pickles, and a spicy chipotle mayo. Served on a brioche bun.</p>
          <p class="text-gray-700 mb-2 text-end w-full flex-grow"></p>
          <p class="text-gray-700 mb-2 text-end">$7.99</p>
        </div>
        <div class="bg-white rounded shadow p-6 flex flex-col items-center">
          <img src="data:image/jpeg;base64,<?php echo base64_encode($images_menu[2]); ?>" alt="Menu item" class="img-size mb-6">
          <h2 class="text-lg mb-2">Mediterranean Wrap</h2>
          <p class="text-gray-700 mb-2">A warm tortilla filled with falafel, hummus, tabbouleh, cucumber, tomato, and tahini sauce.</p>
          <p class="text-gray-700 mb-2 text-end w-full flex-grow"></p>
          <p class="text-gray-700 mb-2 text-end">$7.99</p>
        </div>
        <div class="bg-white rounded shadow p-6 flex flex-col items-center">
          <img src="data:image/jpeg;base64,<?php echo base64_encode($images_menu[4]); ?>" alt="Menu item" class="img-size mb-6">
          <h2 class="text-lg mb-2">Shrimp Po'Boy</h2>
          <p class="text-gray-700 mb-2">Lightly breaded and fried shrimp topped with lettuce, tomato, and remoulade sauce. Served on a toasted baguette.</p>
          <p class="text-gray-700 mb-2 text-end w-full flex-grow"></p>
          <p class="text-gray-700 mb-2 text-end">$9.99</p>
        </div>
        <div class="bg-white rounded shadow p-6 flex flex-col items-center">
          <img src="data:image/jpeg;base64,<?php echo base64_encode($images_menu[3]); ?>" alt="Menu item" class="img-size mb-6">
          <h2 class="text-lg mb-2">Grilled Veggie Pesto Pizza</h2>
          <p class="text-gray-700 mb-2">A thin and crispy pizza crust topped with basil pesto, grilled vegetables, mozzarella cheese, and balsamic glaze.</p>
          <p class="text-gray-700 mb-2 text-end w-full flex-grow"></p>
          <p class="text-gray-700 mb-2 text-end">$10.99</p>
        </div>
      </div>
    </div>
    </section>
    <section id="info" class="bg-black py-20">
      <h2 class="text-3xl font-bold text-center text-white mb-10">Info</h2>
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-10 text-white flex items-center justify-center px-4">
        <div class="rounded shadow p-6 flex flex-col items-center">
          <span class="material-symbols-outlined mb-2">
          schedule
          </span>
          <p class="mb-2 text-lg">Opening Hours</p>
          <p class="text-sm mb-2 text-center">Open every day except Monday<br>from 11AM to 11PM.</p>
        </div>
        <div class="rounded shadow p-6 flex flex-col items-center">
          <span class="material-symbols-outlined mb-2">
            home
          </span>
          <p class="mb-2 text-lg">Address</p>
          <p class="mb-2 text-center text-sm">Rue du Pont-au-Lin, 52<br>1390 - Grez-Doiceau</p>
        </div>
        <div class="w-full overflow-hidden px-10 sm:p-0">
          <iframe src="https://www.google.com/maps/d/embed?mid=1tGvaK9ICCLxiVgsj76OfuYAhVwpo7Bw&hl=fr&ehbc=2E312F" width="100%" height="100%"></iframe>
          </div>     
      </div>
    </section>
    <section id="contact" class="px-8 flex flex-col justify-center md:items-center mb-10">
    <h1 class="text-black text-center text-4xl mb-6 mt-20">Contact</h1>
    <p class="text-center mb-6">Have a question or want to make a reservation?<br><span class="mt-4 block">Contact us using the form below and we'll get back to you as soon as possible.</span></p>
    <form class="bg-white rounded shadow p-6 flex flex-col sm:w-2/3" method="post">
      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2" for="first-name">First Name</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="first-name" type="text" placeholder="John" name="first-name">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2" for="last-name">Last Name</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="last-name" type="text" placeholder="Doe" name="last-name">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2" for="email">Email</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="john.doe@email.com" name="email">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2" for="subject">Subject</label>
        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="subject" name="subject">
          <option>Reservation</option>
          <option>Information</option>
          <option>Feedback</option>
          <option>Other</option>
        </select>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2" for="message">Message</label>
        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="message" rows="6" name="message"></textarea>
      </div>
      <button class="bg-black text-white p-2">Submit</button>
    </section>
  </body>
</html>