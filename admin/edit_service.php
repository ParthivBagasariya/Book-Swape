<?php
session_start();
include_once "config.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Check if the service ID is provided
if (!isset($_GET['id'])) {
    $_SESSION['alert_msg'] = "Service ID not provided.";
    header("Location: manage.php");
    exit();
}

// Get the service ID from the URL
$service_id = $_GET['id'];

// Fetch service details from the database
$sql = "SELECT * FROM services WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $service_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    $_SESSION['alertError'] = "Service not found.";
    header("Location: manage.php");
    exit();
}
$service = $result->fetch_assoc();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $category = $_POST["category"];
    $subcategory = $_POST["subcategory"];
    $name = $_POST["name"];
    $price = $_POST["price"];

    // Initialize an array to hold parameters for the prepared statement
    $params = [];
    // Start building the SQL query
    $sql = "UPDATE services SET category = ?, subcategory = ?, name = ?, price = ?";

    // Add form data to the parameters array
    array_push($params, $category, $subcategory, $name, $price);

    // Check if an image file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_name = $_FILES['image']['name'];
        // Determine the upload directory and img_path based on subcategory
        switch ($subcategory) {
            case "Haldi":
                $upload_dir = "../php/img/Haldi/";
                $img_path = "Haldi/" . $image_name;
                break;
            case "Mahendi":
                $upload_dir = "../php/img/Mahendi/";
                $img_path = "Mahendi/" . $image_name;
                break;
            case "Mandap":
                $upload_dir = "../php/img/Mandap/";
                $img_path = "Mandap/" . $image_name;
                break;
            case "Vanarasam":
                $upload_dir = "../php/img/Vanarasam/";
                $img_path = "Vanarasam/" . $image_name;
                break;
            case "Children's Birthday":
                $upload_dir = "../php/img/Children_Birthday/";
                $img_path = "Child_Birthday/" . $image_name;
                break;
            case "Adult Birthday":
                $upload_dir = "../php/img/Adult_Birthday/";
                $img_path = "Adult_Birthday/" . $image_name;
                break;
            default:
                $upload_dir = "../php/img/";
                $img_path = "uploaded/" . $image_name;
                break;
        }
        // Move the uploaded image to the appropriate directory
        if (move_uploaded_file($image_tmp_name, $upload_dir . $image_name)) {
            // If the image is successfully uploaded, append the image path update to the SQL query
            $sql .= ", img = ?";
            array_push($params, $img_path);
        }
    }

    // Append WHERE clause to the SQL query
    $sql .= " WHERE id = ?";
    array_push($params, $service_id);

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat("s", count($params) - 1) . "i", ...$params);
    $stmt->execute();

    // Set session alert message
    $_SESSION['alertSuccess'] = "Service updated successfully.";

    // Redirect to manage.php
    header("Location: manage.php");
    exit();
}



include_once "header.php";
include_once "_navbar.php";
include "../php/alerts.php";


?>
<div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border mt-8">
    <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
        <div class="flex items-center justify-center gap-8 mb-8">
            <div>
                <h5 class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    Edit Service
                </h5>
            </div>
        </div>


    </div>
</div>
<form method="post" class="max-w-sm mx-auto my-6" enctype="multipart/form-data">
    <div class="mb-5">
        <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
        <select id="category" name="category" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            <option value="">Select Category</option>
            <option value="Wedding" <?php echo ($service['category'] == 'Wedding') ? 'selected' : ''; ?>>Wedding</option>
            <option value="Birthday Parties" <?php echo ($service['category'] == 'Birthday Parties') ? 'selected' : ''; ?>>Birthday Parties</option>
        </select>
    </div>
    <div class="mb-5">
        <label for="subcategory" class="block mb-2 text-sm font-medium text-gray-900">Subcategory</label>
        <select id="subcategory" name="subcategory" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            <?php if ($service['category'] == 'Wedding') : ?>
                <option value="Mahendi" <?php echo ($service['subcategory'] == 'Mahendi') ? 'selected' : ''; ?>>Mahendi</option>
                <option value="Haldi" <?php echo ($service['subcategory'] == 'Haldi') ? 'selected' : ''; ?>>Haldi</option>
                <option value="Vanarasam" <?php echo ($service['subcategory'] == 'Vanarasam') ? 'selected' : ''; ?>>Vanarasam</option>
                <option value="Mandap" <?php echo ($service['subcategory'] == 'Mandap') ? 'selected' : ''; ?>>Mandap</option>
            <?php elseif ($service['category'] == 'Birthday Parties') : ?>
                <option value="Children's Birthday" <?php echo ($service['subcategory'] == "Children's Birthday") ? 'selected' : ''; ?>>Children's Birthday</option>
                <option value="Adult Birthday" <?php echo ($service['subcategory'] == 'Adult Birthday') ? 'selected' : ''; ?>>Adult Birthday</option>
            <?php endif; ?>
        </select>
    </div>
    <div class="mb-5">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
        <input type="text" id="name" name="name" value="<?php echo $service['name']; ?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
    </div>
    <div class="mb-5">
        <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price</label>
        <input type="number" id="price" name="price" value="<?php echo $service['price']; ?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
    </div>
    <div class="mb-5">
        <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Image</label>
        <input type="file" id="image" name="image" accept="image/*" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update Service</button>

    <a href="manage.php">
        <button class="text-white bg-black font-medium rounded-lg text-sm px-5 py-2.5 text-center">Back</button>
    </a>
</form>


<script>
    // Function to dynamically change subcategory options based on selected category
    document.getElementById("category").addEventListener("change", function() {
        var category = this.value;
        var subcategorySelect = document.getElementById("subcategory");
        // Clear previous options
        subcategorySelect.innerHTML = "";
        // Add options based on selected category
        if (category === "Wedding") {
            addOption(subcategorySelect, "Mahendi", "Mahendi");
            addOption(subcategorySelect, "Haldi", "Haldi");
            addOption(subcategorySelect, "Vanarasam", "Vanarasam");
            addOption(subcategorySelect, "Mandap", "Mandap");
        } else if (category === "Birthday Parties") {
            addOption(subcategorySelect, "Children's Birthday", "Children's Birthday");
            addOption(subcategorySelect, "Adult Birthday", "Adult Birthday");
        }
    });

    // Function to add an option to a select element
    function addOption(selectElement, text, value) {
        var option = document.createElement("option");
        option.textContent = text;
        option.value = value;
        selectElement.appendChild(option);
    }
</script>
</body>

</html>