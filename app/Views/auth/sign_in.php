<?php include __DIR__ . '/../common/head.php'; ?>

<?php if (isset($_SESSION['flash']['error'])): ?>
    <div style="color: red;">
        <?= $_SESSION['flash']['error']; ?>
    </div>
<?php endif; ?>

<div class="flex flex-col lg:flex-row h-screen">
    <!-- Left column -->
    <div class="bg-gray-50 lg:w-1/2 flex items-center justify-center">
        <div class="mx-auto max-w-md py-12 px-4 sm:px-6 lg:px-8">
            <div class="space-y-6">
                <h2 class="text-center text-2xl font-extrabold text-gray-900">
                    Sign in to your account
                </h2>
                <div class="flex flex-col space-y-4">
                    <!-- Google sign-in button -->
                    <a href="#" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fa fa-google fa-fw mr-2"></i>Sign in with Google
                    </a>
                    <!-- Email and password input fields -->
                    <div>
                        <label for="email" class="block text-gray-700 font-bold mb-2">
                            Email address
                        </label>
                        <input id="email" name="email" type="email" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm">
                    </div>
                    <div>
                        <label for="password" class="block text-gray-700 font-bold mb-2">
                            Password
                        </label>
                        <input id="password" name="password" type="password" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm">
                    </div>
                    <!-- Login and registration buttons -->
                    <div>
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Log in
                        </button>
                    </div>
                    <div class="text-center">
                        <span class="text-gray-600">Don't have an account?</span>
                        <a href="#" class="text-blue-600 hover:text-blue-800">Register now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Right column -->
    <div class="hidden lg:block lg:w-1/2 bg-cover bg-center"
        style="background-image: url('https://via.placeholder.com/800x600')">
    </div>
</div>



<?php include __DIR__ . '/../common/footer.php'; ?>