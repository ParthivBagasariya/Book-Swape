<?php

include_once "header.php";
include_once "components/_navbar.php";
?>

<script src="https://cdn.tailwindcss.com"></script>
<h2 class="text-2xl font-semibold text-center mt-3 text-gray-800 capitalize lg:text-3xl bg-clip-text bg-gray-200">Gallery Pics</h2>
<div class="grid min-h-[140px] w-full place-items-center overflow-x-scroll rounded-lg p-6 lg:overflow-visible">
  <div class="grid grid-cols-4 gap-2">
    <div class="">
      <img class="object-cover object-center h-60 max-w-full rounded-lg md:h-80"
        src="pics/1.jpg"
        alt="" />
    </div>
    <div>
      <img class="object-cover object-center h-60 max-w-full rounded-lg md:h-80"
        src="pics/2.jpg"
        alt="" />
    </div>
    <div>
      <img class="object-cover object-center h-60 max-w-full rounded-lg md:h-80"
        src="pics/3.jpg"
        alt="" />
    </div>
    <div>
      <img class="object-cover object-center h-60 max-w-full rounded-lg md:h-80"
        src="pics/4.jpg"
        alt="" />
    </div>
    <div>
      <img class="object-cover object-center h-60 max-w-full rounded-lg md:h-80"
        src="pics/7.jpg"
        alt="" />
    </div>
    <div>
      <img class="object-cover object-center h-60 max-w-full rounded-lg md:h-80"
        src="pics/14.jpg"
        alt="" />
    </div>
    <div>
      <img class="object-cover object-center h-60 max-w-full rounded-lg md:h-80"
        src="pics/6.png"
        alt="" />
    </div>
    <div>
      <img class="object-cover object-center h-60 max-w-full rounded-lg md:h-80"
        src="pics/15.jpg"
        alt="" />
    </div>
  </div>
</div>

<!-- <div class="grid grid-cols-2 gap-2">
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-3.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-4.jpg" alt="">
        </div>
    </div> -->



<?php include_once "components/_footer.php"; ?>
</body>
</html>