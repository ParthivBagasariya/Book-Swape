<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit();
}

include_once "config.php";
include_once "header.php";
include_once "_navbar.php";
?>

<div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border mt-8">
  <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
    <div class="flex items-center justify-between gap-8 mb-8">
      <div>
        <h5 class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
          Orders List
        </h5>
        <p class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
          See all Orders Details
        </p>
      </div>
      <div class="py-4 px-4">
        <button data-modal-target="gen-report-modal" data-modal-toggle="gen-report-modal" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
          <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
            Generate Report
          </span>
        </button>
      </div>
    </div>


  </div>
</div>

<!-- Generate Report modal -->
<div id="gen-report-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative p-4 w-full max-w-md max-h-full">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow">
      <!-- Modal header -->
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
        <h3 class="text-xl font-semibold text-gray-900">
          Generate Report
        </h3>
        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="gen-report-modal">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <div class="px-6 py-6 lg:px-8">
        <form method="post" action="gen_report.php" class="space-y-4" autocomplete="TRUE">
          <div>
            <label for="from-date" class="block mb-2 text-sm font-semibold text-gray-900">From Date</label>
            <input class="bg-gray-200 border border-gray-300 text-gray-700 text-sm rounded-lg focus:outline-none focus:bg-white focus:border-blue-500 w-full py-3 px-4 mb-3 leading-tight" id="from-date" name="from-date" type="date" value="<?php echo date('Y-m-d'); ?>" required>
          </div>
          <div>
            <label for="to-date" class="block mb-2 text-sm font-semibold text-gray-900">To Date</label>
            <input class="bg-gray-200 border border-gray-300 text-gray-700 text-sm rounded-lg focus:outline-none focus:bg-white focus:border-blue-500 w-full py-3 px-4 mb-3 leading-tight" id="to-date" name="to-date" type="date" value="<?php echo date('Y-m-d'); ?>" required>
          </div>
          <button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Generate Report</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
  <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
    <div class="p-6 px-0 overflow-scroll">
      <table class="w-full mt-4 text-left table-auto min-w-max">
        <thead>
          <tr>
            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
              <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                Order ID
              </p>
            </th>
            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
              <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                Customer Name
              </p>
            </th>
            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
              <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                Phone Number
              </p>
            </th>
            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
              <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                Theme Names
              </p>
            </th>
            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
              <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                Booking Date
              </p>
            </th>
            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
              <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                Event Date
              </p>
            </th>
            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
              <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                Time
              </p>
            </th>
            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
              <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                Address
              </p>
            </th>
            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
              <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                Total Amount
              </p>
            </th>
            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
              <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                Token Number
              </p>
            </th>
            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
              <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                Payment Method
              </p>
            </th>
            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
              <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                Payment Status
              </p>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Fetch orders from the database
          $sql = "SELECT * FROM orders ORDER BY id DESC";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td class='p-4 border-b border-blue-gray-50'>" . $row["id"] . "</td>";
              echo "<td class='p-4 border-b border-blue-gray-50'>" . $row["customer_name"] . "</td>";
              echo "<td class='p-4 border-b border-blue-gray-50'>" . $row["phone_number"] . "</td>";
              echo "<td class='p-4 border-b border-blue-gray-50'>" . $row["item_names"] . "</td>";
              echo "<td class='p-4 border-b border-blue-gray-50'>" . $row["placed_on"] . "</td>";
              $orderDate = date("m/d/Y", strtotime($row["order_date"]));
              echo "<td class='p-4 border-b border-blue-gray-50'>" . $orderDate . "</td>";
              echo "<td class='p-4 border-b border-blue-gray-50'>" . $row["order_time"] . "</td>";
              echo "<td class='p-4 border-b border-blue-gray-50'>" . $row["address"] . "</td>";
              echo "<td class='p-4 border-b border-blue-gray-50'>₹" . $row["total_amount"] . "</td>";
              echo "<td class='p-4 border-b border-blue-gray-50'>" . $row["token_no"] . "</td>";
              echo "<td class='p-4 border-b border-blue-gray-50'>" . $row["payment_method"] . "</td>";
              echo "<td class='p-4 border-b border-blue-gray-50'>" . $row["payment_status"] . "</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='7'>0 results</td></tr>";
          }
          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>