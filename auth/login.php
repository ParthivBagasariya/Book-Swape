<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-lg text-center">
    <h1 class="text-2xl font-bold sm:text-3xl">Login - Bookswap</h1>
  </div>

  <form action="../php/login.php" method="POST" enctype="multipart/form-data" autocomplete="on" class="form login mx-auto mt-8 mb-0 max-w-md space-y-4">
    <div>
      <label for="email" class="sr-only">Email</label>

      <div class="relative field input">
        <input
          type="email" name="email"
          class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm"
          placeholder="Enter email"
        />

        <span class="absolute inset-y-0 right-4 inline-flex items-center">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 text-gray-400"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"
            />
          </svg>
        </span>
      </div>
    </div>

    <div>
      <label for="password" class="sr-only">Password</label>
      <div class="relative field input">
        <input
          type="password" name="password" id="pass1"
          class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm"
          placeholder="Enter password"
        />

        <span class="absolute inset-y-0 right-4 inline-flex items-center" onclick="togglePasswordVisibility()">
          <svg id="eyeOpen" class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4 6-9 6s-9-4.8-9-6c0-1.2 4-6 9-6s9 4.8 9 6Z"/>
            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
          </svg>
          <svg id="eyeClosed" class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" style="display: none">
            <path d="m4 15.6 3-3V12a5 5 0 0 1 5-5h.5l1.8-1.7A9 9 0 0 0 12 5C6.6 5 2 10.3 2 12c.3 1.4 1 2.7 2 3.6Z"/>
            <path d="m14.7 10.7 5-5a1 1 0 1 0-1.4-1.4l-5 5A3 3 0 0 0 9 12.7l.2.6-5 5a1 1 0 1 0 1.4 1.4l5-5 .6.2a3 3 0 0 0 3.6-3.6 3 3 0 0 0-.2-.6Z"/>
            <path d="M19.8 8.6 17 11.5a5 5 0 0 1-5.6 5.5l-1.7 1.8 2.3.2c6.5 0 10-5.2 10-7 0-1.2-1.6-2.9-2.2-3.4Z"/>
          </svg>
        </span>
      </div>
    </div>

    <div class="flex items-center justify-between">
      <p class="text-sm text-gray-500">
        No account?
        <a class="underline" href="auth.php?auth=signup">Sign up</a>
      </p>

      <button
        type="submit"
        class="field button ml-3 inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white"
      >
        Log In
      </button>
    </div>
  </form>
</div>

<script>
function togglePasswordVisibility() {
  var passwordInput = document.getElementById("pass1");
  var eyeIconOpen = document.getElementById("eyeOpen");
  var eyeIconClosed = document.getElementById("eyeClosed");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    eyeIconOpen.style.display = "none";
    eyeIconClosed.style.display = "block";
  } else {
    passwordInput.type = "password";
    eyeIconOpen.style.display = "block";
    eyeIconClosed.style.display = "none";
  }
}
</script>