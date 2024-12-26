<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include_once "config.php";
include_once "header.php";
include_once "_navbar.php";

// Fetch total count of users from the database
$query = "SELECT COUNT(*) as total_users FROM users";
$result = mysqli_query($conn, $query);
$totalUsers = mysqli_fetch_assoc($result)['total_users'];

?>

<div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
    <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
        <div class="flex items-center justify-between gap-8 mb-8">
            <div>
                <h5 class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    Users List
                </h5>
                <p class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                    See information about all users
                </p>
            </div>
            <div>
                <p class="block font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                    Total Users: <?php echo $totalUsers; ?>
                </p>
            </div>
        </div>
        <div class="p-6 px-0 overflow-scroll">
            <table class="w-full mt-4 text-left table-auto min-w-max">
                <thead>
                    <tr>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Sr No
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Unique ID
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Username
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Email
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Phone
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch users from the database
                    $query = "SELECT * FROM users";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        // Counter for serial number
                        $serialNumber = 1;

                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td class='p-4 border-b border-blue-gray-50'>" . $serialNumber++ . "</td>";
                            echo "<td class='p-4 border-b border-blue-gray-50'>" . $row["unique_id"] . "</td>";
                            echo "<td class='p-4 border-b border-blue-gray-50'>" . $row["username"] . "</td>";
                            echo "<td class='p-4 border-b border-blue-gray-50'>" . $row["email"] . "</td>";
                            echo "<td class='p-4 border-b border-blue-gray-50'>" . $row["phone"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>0 results</td></tr>";
                    }
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
