<?php include __DIR__ . '/../common/head.php'; ?>

<?php include __DIR__ . '/../common/nav.php'; ?>

<div class="p-4 sm:ml-64 mt-10">

<a href="/deliveries/create">
<button class="my-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full flex items-center">
  <svg class="fill-current mr-2" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
  </svg>
  Create Delivery
</button>
</a>

<div class="px-4 py-2 bg-gray-50 shadow-md rounded-lg">
<div class="mb-4">
  <label class="block text-gray-700 font-bold mb-2" for="search">
    Search:
  </label>
  <input class="appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="search" type="text" placeholder="Search...">
</div>
  <table class="w-full table-auto">
    <thead>
      <tr class="border-b-2 border-gray-300">
        <th class="text-left font-medium text-gray-600 uppercase px-4 py-2">ID</th>
        <th class="text-left font-medium text-gray-600 uppercase px-4 py-2">Recipient Name</th>
        <th class="text-left font-medium text-gray-600 uppercase px-4 py-2">City</th>
        <th class="text-left font-medium text-gray-600 uppercase px-4 py-2">Address</th>
        <th class="text-left font-medium text-gray-600 uppercase px-4 py-2">Zip</th>
        <th class="text-left font-medium text-gray-600 uppercase px-4 py-2">Phone</th>
        <th class="text-left font-medium text-gray-600 uppercase px-4 py-2">Status</th>
        <th class="text-left font-medium text-gray-600 uppercase px-4 py-2">Responsible Person</th>
        <th class="text-left font-medium text-gray-600 uppercase px-4 py-2"></th>
      </tr>
    </thead>
    <tbody id="table-body">
    <?php
    foreach ($deliveries as $row) {
        echo '<tr class="border-b border-gray-300 hover:bg-gray-100">';
        echo '<td class="text-gray-800 px-4 py-2">' . $row['id'] . '</td>';
        echo '<td class="text-gray-800 px-4 py-2">' . $row['recipient_name'] . '</td>';
        echo '<td class="text-gray-800 px-4 py-2">' . $row['city'] . '</td>';
        echo '<td class="text-gray-800 px-4 py-2">' . $row['address'] . '</td>';
        echo '<td class="text-gray-800 px-4 py-2">' . $row['zip'] . '</td>';
        echo '<td class="text-gray-800 px-4 py-2">' . $row['phone'] . '</td>';
        echo '<td class="text-gray-800 px-4 py-2">' . $row['status'] . '</td>';
        echo '<td class="text-gray-800 px-4 py-2">' . $row['resposible_person_name'] . '</td>';
    ?>
          <td class="border px-4 py-2">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
              Edit
            </button>
          </td>
    <?php
        echo '</tr>';
    }
    ?>
    </tbody>
  </table>
</div>   
</div>

<script>
  const searchInput = document.querySelector('#search');
  const tableBody = document.querySelector('#table-body');

  searchInput.addEventListener('input', () => {
    const searchQuery = searchInput.value.trim().toLowerCase();
    const rows = tableBody.querySelectorAll('tr');

    rows.forEach(row => {
      const cells = row.querySelectorAll('td');
      let foundMatch = false;

      cells.forEach(cell => {
        if (cell.textContent.toLowerCase().includes(searchQuery)) {
          foundMatch = true;
        }
      });

      if (foundMatch) {
        row.classList.remove('hidden');
      } else {
        row.classList.add('hidden');
      }
    });
  });
</script>

<?php include __DIR__ . '/../common/footer.php'; ?>
