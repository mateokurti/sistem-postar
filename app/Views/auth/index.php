<?php include __DIR__ . '/../common/head.php'; ?>

<div class="fixed top-0 left-0 w-full h-full overflow-hidden z-0">
  <video autoplay muted loop class="w-full h-full object-cover">
    <source src="/assets/video/background.mp4" type="video/mp4">
  </video>
  <div class="absolute top-0 left-0 w-full h-full bg-black opacity-80"></div>
  <div class="absolute top-0 left-0 w-full h-full bg-black opacity-10"></div>
</div>

<div class="flex items-center justify-center h-screen relative z-10">
    <div class="py-6 w-full">
        <div class="flex bg-white rounded-lg shadow-lg overflow-hidden mx-auto max-w-sm lg:max-w-4xl">
            <div class="hidden lg:block lg:w-1/2 bg-cover" style="background-image:url('/assets/img/courier.jpg')"></div>
            <div class="w-full p-8 lg:w-1/2">
                <p class="text-xl text-gray-600 text-center">Welcome back!</p>
                <a href="<?php echo $googleAuthUrl; ?>" class="flex items-center justify-center mt-4 text-white rounded-lg shadow-md hover:bg-gray-100">
                    <div class="px-4 py-3">
                        <svg class="h-6 w-6" viewBox="0 0 40 40">
                        <path d="M36.3425 16.7358H35V16.6667H20V23.3333H29.4192C28.045 27.2142 24.3525 30 20 30C14.4775 30 10 25.5225 10 20C10 14.4775 14.4775 9.99999 20 9.99999C22.5492 9.99999 24.8683 10.9617 26.6342 12.5325L31.3483 7.81833C28.3717 5.04416 24.39 3.33333 20 3.33333C10.7958 3.33333 3.33335 10.7958 3.33335 20C3.33335 29.2042 10.7958 36.6667 20 36.6667C29.2042 36.6667 36.6667 29.2042 36.6667 20C36.6667 18.8825 36.5517 17.7917 36.3425 16.7358Z" fill="#FFC107"/>
                            <path d="M5.25497 12.2425L10.7308 16.2583C12.2125 12.59 15.8008 9.99999 20 9.99999C22.5491 9.99999 24.8683 10.9617 26.6341 12.5325L31.3483 7.81833C28.3716 5.04416 24.39 3.33333 20 3.33333C13.5983 3.33333 8.04663 6.94749 5.25497 12.2425Z" fill="#FF3D00"/>
                            <path d="M20 36.6667C24.305 36.6667 28.2167 35.0192 31.1742 32.34L26.0159 27.975C24.3425 29.2425 22.2625 30 20 30C15.665 30 11.9842 27.2359 10.5975 23.3784L5.16254 27.5659C7.92087 32.9634 13.5225 36.6667 20 36.6667Z" fill="#4CAF50"/>
                            <path d="M36.3425 16.7358H35V16.6667H20V23.3333H29.4192C28.7592 25.1975 27.56 26.805 26.0133 27.9758C26.0142 27.975 26.015 27.975 26.0158 27.9742L31.1742 32.3392C30.8092 32.6708 36.6667 28.3333 36.6667 20C36.6667 18.8825 36.5517 17.7917 36.3425 16.7358Z" fill="#1976D2"/>
                        </svg>
                    </div>
                    <h1 class="px-4 py-3 w-5/6 text-center text-gray-600 font-bold">Continue with Google</h1>
                </a>
                <div class="mt-4 flex items-center justify-between">
                    <span class="border-b w-1/5 lg:w-1/4"></span>
                    <p class="text-xs text-center text-gray-500 uppercase">or log in with email</p>
                    <span class="border-b w-1/5 lg:w-1/4"></span>
                </div>
                <?php include __DIR__ . '/components/login-form.php'; ?>
                <?php include __DIR__ . '/components/reset-password-form.php'; ?>
                <?php include __DIR__ . '/components/reset-password-confirm-form.php'; ?>
                <?php include __DIR__ . '/components/signup-form.php'; ?>
                <div class="mt-4 flex items-center justify-between">
                    <span class="border-b w-1/5 md:w-1/4"></span>
                    <a id="show-signup" href="#" class="text-xs text-gray-500 uppercase">or sign up</a>
                    <a id="show-login" href="#" class="text-xs text-gray-500 uppercase hidden">or log in</a>
                    <span class="border-b w-1/5 md:w-1/4"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    const showLoginForm = () => {
        document.getElementById('reset-password-confirm-form').classList.add('hidden');
        document.getElementById('login-form').classList.remove('hidden');
        document.getElementById('signup-form').classList.add('hidden');
        document.getElementById('reset-password-form').classList.add('hidden');

        document.getElementById('show-signup').classList.remove('hidden');
        document.getElementById('show-login').classList.add('hidden');

        window.history.pushState({}, '', '/auth/login');
    }

    const showSignupForm = () => {
        document.getElementById('reset-password-confirm-form').classList.add('hidden');
        document.getElementById('signup-form').classList.remove('hidden');
        document.getElementById('login-form').classList.add('hidden');
        document.getElementById('reset-password-form').classList.add('hidden');

        document.getElementById('show-login').classList.remove('hidden');
        document.getElementById('show-signup').classList.add('hidden');

        window.history.pushState({}, '', '/auth/signup');
    }

    const showResetPasswordForm = () => {
        document.getElementById('reset-password-confirm-form').classList.add('hidden');
        document.getElementById('reset-password-form').classList.remove('hidden');
        document.getElementById('login-form').classList.add('hidden');
        document.getElementById('signup-form').classList.add('hidden');

        document.getElementById('show-login').classList.remove('hidden');
        document.getElementById('show-signup').classList.add('hidden');

        window.history.pushState({}, '', '/auth/reset-password');
    }

    const showResetPasswordConfirmForm = () => {
        document.getElementById('reset-password-confirm-form').classList.remove('hidden');
        document.getElementById('reset-password-form').classList.add('hidden');
        document.getElementById('login-form').classList.add('hidden');
        document.getElementById('signup-form').classList.add('hidden');

        document.getElementById('show-login').classList.remove('hidden');
        document.getElementById('show-signup').classList.add('hidden');
    }

    switch (window.location.pathname) {
        case '/auth/login':
            showLoginForm();
            break;
        case '/auth/signup':
            showSignupForm();
            break;
        case '/auth/reset-password/confirm':
            showResetPasswordConfirmForm();
            break;
        case '/auth/reset-password':
            showResetPasswordForm();
            break;
    }

    document.getElementById('show-login').addEventListener('click', function(e) {
        e.preventDefault();
        showLoginForm();
    });

    document.getElementById('show-signup').addEventListener('click', function(e) {
        e.preventDefault();
        showSignupForm();
    });

    document.getElementById('show-reset-password').addEventListener('click', function(e) {
        e.preventDefault();
        showResetPasswordForm();

        // Copy email from login form to reset password form
        document.getElementById('reset-password-form').querySelector('input[name="email"]').value = document.getElementById('login-form').querySelector('input[name="email"]').value;
    });
</script>

<?php include __DIR__ . '/../common/footer.php'; ?>
