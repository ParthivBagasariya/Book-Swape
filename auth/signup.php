<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
  <div class="mx-auto max-w-lg text-center">
    <h1 class="text-2xl font-bold sm:text-3xl">Get started today!</h1>
    
  </div>

  <form action="../php/signup.php" method="POST" enctype="multipart/form-data" autocomplete="on" class="form login mx-auto mt-8 mb-0 max-w-md space-y-4">
    <div class="flex">
      <div>
        <label for="username" class="sr-only">Username</label>
        <div class="relative field input">
          <input type="text" name="username" onkeyup="nospaces(this)" maxlength="30" class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm" placeholder="Enter Username" />
        </div>
      </div>
    </div>

    <div>
      <label for="email" class="sr-only">Email</label>
      <div class="relative field input">
        <input type="email" name="email" class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm" placeholder="Enter email" />
      </div>
    </div>

    <div>
      <label for="phone" class="sr-only">Phone</label>
      <div class="relative field input">
        <input type="text" name="phone" class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm" placeholder="Enter phone number" />
      </div>
    </div>

    <div>
      <label for="password" class="sr-only">Password</label>
      <div class="relative field input">
        <input type="password" name="password" id="pass1" class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm" placeholder="Enter password" />
        <span class="absolute inset-y-0 right-4 inline-flex items-center" onclick="togglePasswordVisibility('pass1')">
          <svg id="eyeOpen1" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
          </svg>
          <svg id="eyeClosed1" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none">
            <path d="m4 15.6 3-3V12a5 5 0 0 1 5-5h.5l1.8-1.7A9 9 0 0 0 12 5C6.6 5 2 10.3 2 12c.3 1.4 1 2.7 2 3.6Z"/>
            <path d="m14.7 10.7 5-5a1 1 0 1 0-1.4-1.4l-5 5A3 3 0 0 0 9 12.7l.2.6-5 5a1 1 0 1 0 1.4 1.4l5-5 .6.2a3 3 0 0 0 3.6-3.6 3 3 0 0 0-.2-.6Z"/>
            <path d="M19.8 8.6 17 11.5a5 5 0 0 1-5.6 5.5l-1.7 1.8 2.3.2c6.5 0 10-5.2 10-7 0-1.2-1.6-2.9-2.2-3.4Z"/>
          </svg>
        </span>
      </div>
    </div>

    <div>
      <label for="password" class="sr-only">Confirm Password</label>
      <div class="relative field input">
        <input type="password" name="c_password" id="pass2" class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm" placeholder="Confirm Password password" />
        <span class="absolute inset-y-0 right-4 inline-flex items-center" onclick="togglePasswordVisibility('pass2')">
          <svg id="eyeOpen2" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
          </svg>
          <svg id="eyeClosed2" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none">
            <path d="m4 15.6 3-3V12a5 5 0 0 1 5-5h.5l1.8-1.7A9 9 0 0 0 12 5C6.6 5 2 10.3 2 12c.3 1.4 1 2.7 2 3.6Z"/>
            <path d="m14.7 10.7 5-5a1 1 0 1 0-1.4-1.4l-5 5A3 3 0 0 0 9 12.7l.2.6-5 5a1 1 0 1 0 1.4 1.4l5-5 .6.2a3 3 0 0 0 3.6-3.6 3 3 0 0 0-.2-.6Z"/>
            <path d="M19.8 8.6 17 11.5a5 5 0 0 1-5.6 5.5l-1.7 1.8 2.3.2c6.5 0 10-5.2 10-7 0-1.2-1.6-2.9-2.2-3.4Z"/>
          </svg>
        </span>
      </div>
    </div>

    <div class="flex items-center justify-between">
      <p class="text-sm text-gray-500">
        Already have an account?
        <a class="underline" href="auth.php?auth=login">Login</a>
      </p>
      <button type="submit" class="field button ml-3 inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white">
        Sign Up
      </button>
    </div>
  </form>
</div>

<script>
function togglePasswordVisibility(passwordId) {
  var passwordInput = document.getElementById(passwordId);
  var eyeOpen = document.getElementById("eyeOpen" + passwordId.charAt(passwordId.length - 1));
  var eyeClosed = document.getElementById("eyeClosed" + passwordId.charAt(passwordId.length - 1));

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    eyeOpen.style.display = "none";
    eyeClosed.style.display = "block";
  } else {
    passwordInput.type = "password";
    eyeOpen.style.display = "block";
    eyeClosed.style.display = "none";
  }
}
</script>