
<div id="create-delivery-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="create-delivery-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Krijo Dërgesë</h3>
                    <form class="max-w-lg mx-auto" action="/deliveries/create" method="POST">
                      <div class="mt-4">
                          <div class="flex justify-between">
                              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Emaili i Marrësit</label>
                          </div>
                          <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" id="recipient_email" name="recipient_email" type="email" placeholder="filan.fisteku@shembull.al" required>
                      </div>
                      <div class="mt-4">
                          <div class="flex justify-between">
                              <div class="w-1/2 mr-1">
                                  <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                                  <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" type="text" name="recipient_first_name" placeholder="Filan" required>
                              </div>
                              <div class="w-1/2 ml-1">
                                  <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                                  <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" type="text" name="recipient_last_name" placeholder="Fisteku" required>
                              </div>
                          </div>
                      </div>
                      <div class="mt-4 flex items-center justify-between">
                          <span class="border-b w-full"></span>
                      </div>
                      <div class="mt-4">
                          <div class="flex justify-between">
                              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresa</label>
                          </div>
                          <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" id="recipient_address_street" name="recipient_address_street" type="text" placeholder="Rr. Sami Frashëri, Nd. 15, H. 1, Ap. 12" required>
                      </div>

                      <div class="mt-4">
                          <div class="flex justify-between">
                              <div class="w-1/2 mr-1">
                                  <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Qyteti</label>
                                  <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" id="recipient_address_city" name="recipient_address_city" required>
                                      <option value="" disabled selected>Zgjidh Qytetin</option>
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
                                      <option value="Dimal">Dimal</option>
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
                              <div class="w-1/2 ml-1">
                                  <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kodi Postar</label>
                                  <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" type="number" name="recipient_address_zip_code" placeholder="1003" required>
                              </div>
                          </div>
                      </div>

                      <div class="mt-4">
                          <div class="flex justify-between">
                              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shënime</label>
                          </div>
                          <textarea class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" id="notes" name="notes" placeholder="Shënime"></textarea>
                      </div>
                      <div class="mt-8">
                          <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:hover:bg-gray-900 dark:focus:ring-gray-900">Dërgo</button>
                      </div>
                    </form>
                </div>
        </div>
    </div>
</div>


