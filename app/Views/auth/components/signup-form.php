                <form id="signup-form" class="hidden" action="/auth/signup" method="POST">
                    <div class="mb-4">
                      <label class="block text-gray-700 font-bold mb-2" for="account_type">
                        Account Type
                      </label>
                      <select class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="account_type" name="account_type" required>
                        <option value="" disabled selected>Select an account type</option>
                        <option value=1>User</option>
                        <option value=2>Courier</option>
                        <option value=3>Post Office</option>
                      </select>
                    </div>
                   <div class="mt-4">
                        <div class="flex justify-between">
                            <div class="w-1/2 mr-1">
                                <label class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
                                <input class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="first_name" name="first_name" placeholder="Filan" required>
                            </div>
                            <div class="w-1/2 ml-1">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Last Name</label>
                                <input class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="last_name" name="last_name" placeholder="Fisteku" required>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                        <input
                            class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none"
                            type="email" name="email" placeholder="hello@fshn.edu.al" required>
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <input 
                            class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none"
                            type="password" name="password" placeholder="••••••••••"
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                            title="The password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number."
                            required>
                    </div>
                    <?php if (isset($_SESSION['flash']['error']) && $_SESSION['flash']['error']['form'] === '/auth/signup'): ?>
                        <div class="mt-4">
                            <p class="text-red-500 text-xs italic" id="signup-form-warning"><?= $_SESSION['flash']['error']['message']; ?></p>
                        </div>
                    <?php unset($_SESSION['flash']['error']); endif; ?>
                    <div class="mt-8">
                        <button type="submit" class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600">Sign Up</button>
                    </div>
                </form>
