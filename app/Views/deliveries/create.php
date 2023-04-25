<?php include __DIR__ . '/../common/head.php'; ?>


<?php include __DIR__ . '/../common/nav.php'; ?>

<div class="p-4 sm:ml-64 mt-10">
<form class="max-w-lg mx-auto" action="/deliveries/create" method="POST">
  <div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2" for="recipient_name">
      Recipient Name
    </label>
    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="recipient_name" name="recipient_name" type="text" placeholder="Recipient Name" required>
  </div>

<div class="mb-4">
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
  </div>
  <div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2" for="notes">
      Notes
    </label>
    <textarea class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="notes" name="notes" placeholder="Notes"></textarea>
  </div>
  <div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2" for="status">
      Status
    </label>
    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="status" name="status" type="text" placeholder="Status" required>
  </div>
  <div class="flex items-center justify-between">
    <input type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
    </input>
  </div>
</form>
</div>


<?php include __DIR__ . '/../common/footer.php'; ?>
