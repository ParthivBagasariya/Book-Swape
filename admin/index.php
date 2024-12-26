<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit();
}

include_once "config.php";
include_once "header.php";
include_once "_navbar.php";

// Get the count of orders
$sql = "SELECT COUNT(*) AS order_count FROM orders";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$orderCount = $row['order_count'];

// Get the count of services
$sql = "SELECT COUNT(*) AS service_count FROM services";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$serviceCount = $row['service_count'];

// Get the count of users
$sql = "SELECT COUNT(*) AS user_count FROM users";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$userCount = $row['user_count'];

// Get the count of admin
$sql = "SELECT COUNT(*) AS admin_count FROM admin";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$adminCount = $row['admin_count'];

// Get the username from the admin table
$sql = "SELECT name FROM admin WHERE email = '$_SESSION[admin_email]'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$username = $row['name'];
?>

<div class="py-4 px-4 text-lg flex justify-center">Welcome Back, <span class="font-bold"> <?php echo $username; ?></span></div>

<div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
  <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
    <?php
    $elements = [
      [
        'count' => $orderCount,
        'title' => 'Orders',
        'url' => 'orders.php'
      ],
      [
        'count' => $serviceCount,
        'title' => 'Services',
        'url' => 'manage.php'
      ],
      [
        'count' => $userCount,
        'title' => 'Users',
        'url' => 'users.php'
      ],
      [
        'count' => $adminCount,
        'title' => 'Admin',
        'url' => 'add_admin.php'
      ]
    ];

    foreach ($elements as $element) {
    ?>
      <div class="text-center">
        <div class="flex items-center justify-center w-10 h-10 mx-auto mb-3 rounded-full bg-indigo-50 sm:w-12 sm:h-12">
          <svg class="w-8 h-8 text-deep-purple-accent-400 sm:w-10 sm:h-10" stroke="currentColor" viewBox="0 0 52 52">
            <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none" points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
          </svg>
        </div>
        <h6 class="text-4xl font-bold text-deep-purple-accent-400"><?php echo $element['count']; ?></h6>
        <p class="mb-2 font-bold text-md"><?php echo $element['title']; ?></p>
        <a href="<?php echo $element['url']; ?>">
          <button class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
              view
            </span>
          </button>
        </a>
      </div>
    <?php
    }
    ?>
  </div>
</div>


</body>
</html>
