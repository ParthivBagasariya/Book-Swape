<?php
session_start();
if (isset($_SESSION['unique_id'])) {
  header("location: ../index.php");
}
?>

<?php include_once "../header.php"; ?>
<nav class="bg-white border-gray-600 border-b-2 rounded-b-xl ">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-center mx-auto p-4">
    <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="../logo.svg" class="h-12" alt="Bookswap logo" />
      <span class="self-center text-2xl font-bold whitespace-nowrap ">BookSwap</span>
    </a>
    
  </div>
</nav>
<?php include_once "../php/alerts.php"; ?>
<?php
if (isset($_GET['auth'])) {

  if ($_GET['auth'] == 'login') {

    require 'login.php';
  }

  if ($_GET['auth'] == 'signup') {

    require 'signup.php';
  }

  if ($_GET['auth'] == 'forgotpassword') {

    require 'forgotpassword.php';
  }
} 

?>


<div id="contact" class="px-4 pt-16 mt-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 border-t-2 border-purple-400">
  <div class="grid gap-10 row-gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4 justify-content">
    <div class="sm:col-span-2 ">
      <a href="/" aria-label="Go home" title="Company" class="inline-flex items-center">
      <!-- <img src="php/img/logo.png" class="h-12" alt="BookSwap logo" /> -->
        <span class="ml-2 text-xl font-bold tracking-wide text-gray-800 uppercase">BookSwap</span>
      </a>
      <div class="mt-6 lg:max-w-sm ">
        <p class="text-sm text-gray-800">
          We care about exchanging books!
        </p>
        <p class="mt-4 text-sm text-gray-800">
         "BookSwap is a platform that specializes in facilitating the exchange of books between two parties".
        </p>
      </div>
    </div>
    <div class="space-y-2 text-sm">
      <p class="text-base font-bold tracking-wide text-gray-900">Contacts</p>
      <div class="flex">
        <p class="mr-1 text-gray-800">Phone:</p>
        <a href="tel:850-123-5021" aria-label="Our phone" title="Our phone" class="transition-colors duration-300 text-deep-purple-accent-400 hover:text-deep-purple-800">+91 99984 66100</a>
        <a href="tel:850-123-5021" aria-label="Our phone" title="Our phone" class="transition-colors duration-300 text-deep-purple-accent-400 hover:text-deep-purple-800">, +91 94081 99972</a>
      </div>
      <div class="flex">
        <p class="mr-1 text-gray-800">Email:</p>
        <a href="mailto:info@lorem.mail" aria-label="Our email" title="Our email" class="transition-colors duration-300 text-deep-purple-accent-400 hover:text-deep-purple-800">bookswap@gmail.com</a>
      </div>
      <div class="flex">
        <a href="https://www.google.com/maps" target="_blank" rel="noopener noreferrer" aria-label="Our address" title="Our address" class="transition-colors duration-300 text-deep-purple-accent-400 hover:text-deep-purple-800">
        </a>
        <div class="flex items-center mt-1 space-x-3">
          <a href="https://www.instagram.com/bookswap/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-400">
            <svg viewBox="0 0 30 30" fill="currentColor" class="h-6">
              <circle cx="15" cy="15" r="4"></circle>
              <path d="M19.999,3h-10C6.14,3,3,6.141,3,10.001v10C3,23.86,6.141,27,10.001,27h10C23.86,27,27,23.859,27,19.999v-10   C27,6.14,23.859,3,19.999,3z M15,21c-3.309,0-6-2.691-6-6s2.691-6,6-6s6,2.691,6,6S18.309,21,15,21z M22,9c-0.552,0-1-0.448-1-1   c0-0.552,0.448-1,1-1s1,0.448,1,1C23,8.552,22.552,9,22,9z"></path>
            </svg>
          </a>
          <a href="https://api.whatsapp.com/send?phone=8866799347" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-400">
            <!-- <svg viewBox="0 0 24 24" fill="currentColor" class="h-6">
              <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM10.5 17.5C9.67 17.5 9 16.83 9 16V14.5C9 13.67 9.67 13 10.5 13H13.5C14.33 13 15 13.67 15 14.5V16C15 16.83 14.33 17.5 13.5 17.5H10.5ZM16.5 11.5C16.5 11.78 16.39 12.03 16.22 12.22L15.12 13.32C14.94 13.5 14.69 13.5 14.5 13.32L13.5 12.32C13.33 12.15 13.33 11.85 13.5 11.68L14.5 10.68C14.69 10.5 14.94 10.5 15.12 10.68L16.22 11.78C16.39 11.95 16.5 12.21 16.5 12.5V11.5ZM17 14C17 10.13 13.87 7 10 7C6.13 7 3 10.13 3 14C3 17.87 6.13 21 10 21C13.87 21 17 17.87 17 14Z"></path>
            </svg> -->
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="h-6" viewBox="0 0 30 30">
              <path d="M 15 3 C 8.373 3 3 8.373 3 15 C 3 17.251208 3.6323415 19.350068 4.7109375 21.150391 L 3.1074219 27 L 9.0820312 25.431641 C 10.829354 26.425062 12.84649 27 15 27 C 21.627 27 27 21.627 27 15 C 27 8.373 21.627 3 15 3 z M 10.892578 9.4023438 C 11.087578 9.4023438 11.287937 9.4011562 11.460938 9.4101562 C 11.674938 9.4151563 11.907859 9.4308281 12.130859 9.9238281 C 12.395859 10.509828 12.972875 11.979906 13.046875 12.128906 C 13.120875 12.277906 13.173313 12.453437 13.070312 12.648438 C 12.972312 12.848437 12.921344 12.969484 12.777344 13.146484 C 12.628344 13.318484 12.465078 13.532109 12.330078 13.662109 C 12.181078 13.811109 12.027219 13.974484 12.199219 14.271484 C 12.371219 14.568484 12.968563 15.542125 13.851562 16.328125 C 14.986562 17.342125 15.944188 17.653734 16.242188 17.802734 C 16.540187 17.951734 16.712766 17.928516 16.884766 17.728516 C 17.061766 17.533516 17.628125 16.864406 17.828125 16.566406 C 18.023125 16.268406 18.222188 16.319969 18.492188 16.417969 C 18.766188 16.515969 20.227391 17.235766 20.525391 17.384766 C 20.823391 17.533766 21.01875 17.607516 21.09375 17.728516 C 21.17075 17.853516 21.170828 18.448578 20.923828 19.142578 C 20.676828 19.835578 19.463922 20.505734 18.919922 20.552734 C 18.370922 20.603734 17.858562 20.7995 15.351562 19.8125 C 12.327563 18.6215 10.420484 15.524219 10.271484 15.324219 C 10.122484 15.129219 9.0605469 13.713906 9.0605469 12.253906 C 9.0605469 10.788906 9.8286563 10.071437 10.097656 9.7734375 C 10.371656 9.4754375 10.692578 9.4023438 10.892578 9.4023438 z"></path>7969 C 18.766188 16.515969 20.227391 17.235766 20.525391 17.384766 C 20.823391 17.533766 21.01875 17.607516 21.09375 17.728516 C 21.17075 17.853516 21.170828 18.448578 20.923828 19.142578 C 20.676828 19.835578 19.463922 20.505734 18.919922 20.552734 C 18.370922 20.603734 17.858562 20.7995 15.351562 19.8125 C 12.327563 18.6215 10.420484 15.524219 10.271484 15.324219 C 10.122484 15.129219 9.0605469 13.713906 9.0605469 12.253906 C 9.0605469 10.788906 9.8286563 10.071437 10.097656 9.7734375 C 10.371656 9.4754375 10.692578 9.4023438 10.892578 9.4023438 z"></path>
            </svg>
          </a>
        </div>
      </div>
    </div>
    <div>
      <span class="text-base font-bold tracking-wide text-gray-900">Address</span>
      <a href="https://maps.app.goo.gl/WWGYVZnrAAt7ZJ8m6" target="_blank">
      <p class="mt-4 text-sm text-gray-500">
        Shop No 3 Nilkanth Recidency, Near Mangalpangay Hall,Opp Sadguru Garden Nikol Ahmedabad 382350.
      </p>
      </a>
    </div>
  </div>
  <div class="flex flex-col-reverse justify-between pt-5 pb-10 border-t lg:flex-row">
    <p class="text-sm text-gray-600">
      © 2021 BookSwap. All rights reserved.
    </p>
    <ul class="flex flex-col mb-3 space-y-2 lg:mb-0 sm:space-y-0 sm:space-x-5 sm:flex-row">
      <li>
        <a href="/" class="text-sm text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400">F.A.Q</a>
      </li>
      <li>
        <a href="/" class="text-sm text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400">Privacy Policy</a>
      </li>
      <li>
        <a href="/" class="text-sm text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400">Terms &amp; Conditions</a>
      </li>
    </ul>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>


<!-- Blocker -->

<script>
  document.addEventListener('contextmenu', event => event.preventDefault());
  document.onkeydown = function (e) {
    if (event.keyCode == 123) {
      return false;
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
      return false;
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
      return false;
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
      return false;
    }
    if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
      return false;
    }
  }
</script>

<script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
<script>
  function nospaces(t){
  if(t.value.match(/\s/g)){
    t.value=t.value.replace(/\s/g,'');
  }
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
<script src="../javascript/showPass.js"></script>
<script src="../javascript/login.js"></script>
</body>

</html>
