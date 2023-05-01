


<div id="create-delivery-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-white">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="create-delivery-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900">Krijo Dërgesë</h3>
                    <form class="max-w-lg mx-auto" action="/deliveries/create" method="POST">
                      <!-- <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="recipient_name">
                          Emaili i Marrësit
                        </label>
                        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="recipient_name" name="recipient_name" type="text" placeholder="filan.fisteku@shembull.al" required>
                      </div> -->

                      <div class="mt-4">
                          <div class="flex justify-between">
                              <label class="block text-gray-700 text-sm font-bold mb-2">Emaili i Marrësit</label>
                          </div>
                          <input class="text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" id="recipient_email" name="recipient_email" type="text" placeholder="filan.fisteku@shembull.al" required>
                      </div>

                      <div class="mt-4">
                          <div class="flex justify-between">
                              <div class="w-1/2 mr-1">
                                  <label class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
                                  <input class="text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="recipient_first_name" name="recipient_first_name" placeholder="Filan" required>
                              </div>
                              <div class="w-1/2 ml-1">
                                  <label class="block text-gray-700 text-sm font-bold mb-2">Last Name</label>
                                  <input class="text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="recipient_last_name" name="recipient_last_name" placeholder="Fisteku" required>
                              </div>
                          </div>
                      </div>
                      <div class="mt-4 flex items-center justify-between">
                          <span class="border-b w-full"></span>
                          <!-- <p class="text-xs text-center text-gray-500 uppercase">Adresa</p> -->
                          <!-- <span class="border-b w-1/5 lg:w-1/4"></span> -->
                      </div>
                      <div class="mt-4">
                          <div class="flex justify-between">
                              <label class="block text-gray-700 text-sm font-bold mb-2">Adresa</label>
                          </div>
                          <input class="text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" id="recipient_address_street" name="recipient_address_street" type="text" placeholder="Rr. Sami Frashëri, Nd. 15, H. 1, Ap. 12" required>
                      </div>

                      <div class="mt-4">
                          <div class="flex justify-between">
                              <div class="w-1/2 mr-1">
                                  <label class="block text-gray-700 text-sm font-bold mb-2">Qyteti</label>
                                  <input class="text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="recipient_address_city" name="recipient_address_city" placeholder="Tiranë" required>
                              </div>
                              <div class="w-1/2 ml-1">
                                  <label class="block text-gray-700 text-sm font-bold mb-2">Kodi Postar</label>
                                  <input class="text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="recipient_address_zip_code" name="recipient_address_zip_code" placeholder="1003" required>
                              </div>
                          </div>
                      </div>

                      <div class="mt-4">
                          <div class="flex justify-between">
                              <label class="block text-gray-700 text-sm font-bold mb-2">Shënime</label>
                              <!-- <a id="show-reset-password" href="#" class="text-xs text-gray-500">Forget Password?</a> -->
                          </div>
                          <textarea class="text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" id="notes" name="notes" placeholder="Shënime"></textarea>
                      </div>

                    <!-- <div class="mb-4">
                      <label class="block text-gray-700 font-bold mb-2" for="city">
                        City
                      </label>
                      <select class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="city" name="city" required>
                        <option value="" disabled selected>Select a city</option>
                        <option value="Tirana">Tirana</option>
                        <option value="Durrës">Durrës</option>
                        <option value="Vlorë">Vlorë</option>
                        <option value="Kamëz">Kamëz</option>
                        <option value="Fier">Fier</option>
                        <option value="Shkodër">Shkodër</option>
                        <option value="Elbasan">Elbasan</option>
                        <option value="Korçë">Korçë</option>
                        <option value="Sarandë">Sarandë</option>
                        <option value="Berat">Berat</option>
                        <option value="Lushnjë">Lushnjë</option>
                        <option value="Kavajë">Kavajë</option>
                        <option value="Gjirokastër">Gjirokastër</option>
                        <option value="Pogradec">Pogradec</option>
                        <option value="Fushë-Krujë">Fushë-Krujë</option>
                        <option value="Laç">Laç</option>
                        <option value="Kukës">Kukës</option>
                        <option value="Sukth">Sukth</option>
                        <option value="Lezhë">Lezhë</option>
                        <option value="Patos">Patos</option>
                        <option value="Peshkopi">Peshkopi</option>
                        <option value="Librazhd-Qendër">Librazhd-Qendër</option>
                        <option value="Kuçovë">Kuçovë</option>
                        <option value="Krujë">Krujë</option>
                        <option value="Vorë">Vorë</option>
                        <option value="Burrel">Burrel</option>
                        <option value="Libonik">Libonik</option>
                        <option value="Rrëshen">Rrëshen</option>
                        <option value="Belsh">Belsh</option>
                        <option value="Divjakë">Divjakë</option>
                        <option value="Gramsh">Gramsh</option>
                        <option value="Mamurras">Mamurras</option>
                        <option value="Bulqizë">Bulqizë</option>
                        <option value="Vau i Dejës">Vau i Dejës</option>
                        <option value="Shëngjin">Shëngjin</option>
                        <option value="Ballsh">Ballsh</option>
                        <option value="Shijak">Shijak</option>
                        <option value="Bilisht">Bilisht</option>
                        <option value="Rrogozhinë">Rrogozhinë</option>
                        <option value="Librazhd">Librazhd</option>
                        <option value="Cërrik">Cërrik</option>
                        <option value="Roskovec">Roskovec</option>
                        <option value="Peqin">Peqin</option>
                        <option value="Krumë">Krumë</option>
                        <option value="Përmet">Përmet</option>
                        <option value="Prrenjas">Prrenjas</option>
                        <option value="Delvinë">Delvinë</option>
                        <option value="Bajram Curri">Bajram Curri</option>
                        <option value="Ura Vajgurore">Ura Vajgurore</option>
                        <option value="Rubik">Rubik</option>
                        <option value="Tepelenë">Tepelenë</option>
                        <option value="Poliçan">Poliçan</option>
                        <option value="Maliq">Maliq</option>
                        <option value="Çorovodë">Çorovodë</option>
                        <option value="Ersekë">Ersekë</option>
                        <option value="Koplik">Koplik</option>
                        <option value="Pukë">Pukë</option>
                        <option value="Lazarat">Lazarat</option>
                        <option value="Memaliaj">Memaliaj</option>
                      </select>
                    </div>
                      <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="address">
                          Address
                        </label>
                        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="address" name="address" type="text" placeholder="Address" required>
                      </div>
                      <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="zip">
                          Zip
                        </label>
                        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="zip" name="zip" type="text" placeholder="Zip" required>
                      </div>
                      <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="phone">
                          Phone
                        </label>
                        <small class="text-gray-400" >Use +3556XXXXXXXX or 06XXXXXXXX formats</small>
                        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone" name="phone" type="text" placeholder="Phone" pattern="^(0|\+355)6[789]\d{7}$" required>
                      </div> -->
                      <div class="mt-8">
                          <button type="submit" class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600">Dërgo</button>
                      </div>
                    </form>
                </div>
        </div>
    </div>
</div>


