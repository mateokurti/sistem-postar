                <form id="login-form" action="/auth/login" method="POST">
                    <?php if (isset($_SESSION['flash']['success']) && $_SESSION['flash']['success']['form'] === '/auth/login'): ?>
                        <div class="mt-4">
                            <p class="text-green-500 text-xs italic" id="signup-form-warning"><?= $_SESSION['flash']['success']['message']; ?></p>
                        </div>
                    <?php unset($_SESSION['flash']['success']); endif; ?>
                    <div class="mt-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                        <input class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="email" name="email" placeholder="hello@fshn.edu.al" required>
                    </div>
                    <div class="mt-4">
                        <div class="flex justify-between">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                            <a id="show-reset-password" href="#" class="text-xs text-gray-500">Forget Password?</a>
                        </div>
                        <input class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="password" name="password" placeholder="••••••••••" required>
                    </div>
                    <?php if (isset($_SESSION['flash']['error']) && $_SESSION['flash']['error']['form'] === '/auth/login'): ?>
                        <div class="mt-4">
                            <p class="text-red-500 text-xs italic" id="login-form-warning"><?= $_SESSION['flash']['error']['message']; ?></p>
                        </div>
                    <?php unset($_SESSION['flash']['error']); endif; ?>
                    <div class="mt-8">
                        <button type="submit" class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600">Log In</button>
                    </div>
                </form>
