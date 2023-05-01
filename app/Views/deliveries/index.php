<?php include __DIR__ . '/../common/head.php'; ?>

<?php include __DIR__ . '/../common/nav.php'; ?>

<div class="p-4 sm:ml-64 mt-10 bg-white dark:bg-gray-900 h-100">


<?php include __DIR__ . '/create.php'; ?>
<?php include __DIR__ . '/tracking-history.php'; ?>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg my-4">
    <div class="flex items-center justify-between pb-4 bg-white dark:bg-gray-900">
        <div>
            <button data-modal-target="create-delivery-modal" data-modal-toggle="create-delivery-modal" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button">
              Krijo Dërgesë
            </button>
        </div>
        <label for="table-search" class="sr-only">Kërko</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <input type="text" id="table-search-delivery" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Kërko për dërgesë">
        </div>
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    Numri i Gjurmimit
                </th>
                <th scope="col" class="px-6 py-3">
                    Marrësi
                </th>
                <th scope="col" class="px-6 py-3">
                    Adresa
                </th>
                <th scope="col" class="px-6 py-3">
                    Statusi
                </th>
                <th scope="col" class="px-6 py-3">
                    Vendodhja e Pakos
                </th>
                <th scope="col" class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody id="table-deliveries-body">
            <?php
              foreach ($deliveries as $row) {
            ?>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <td class="w-4 p-4">
                      <div class="flex items-center">
                          <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                          <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                      </div>
                  </td>
                  <td class="px-6 py-4">
                      <?= $row['tracking_number'] ?>
                  </td>
                  <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                      <div>
                          <div class="text-base font-semibold"><?= $row['recipient']['first_name'] . ' ' .  $row['recipient']['last_name'] ?></div>
                          <div class="font-normal text-gray-500"><?= $row['recipient']['email'] ?></div>
                      </div>  
                  </th>
                  <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                      <div>
                          <div class="text-base font-normal"><?= $row['address']['street'] ?></div>
                          <div class="font-normal text-gray-500"><?= $row['address']['city'] . ' ' . $row['address']['zip'] ?></div>
                      </div>  
                  </td>
                  
                  <td class="px-6 py-4">
                      <div class="flex items-center">
                          <div class="h-2.5 w-2.5 rounded-full bg-<?= in_array($row['status'], ['returned', 'cancelled', 'lost']) ? 'red' : 'green' ?>-500 mr-2"></div> <?= $row['status'] ?>
                      </div>
                  </td>
                  <?php
                  $holder_title = "S'ka informacion";
                  $holder_subtitle = "";
                  if ($row['holder']['type'] == 'user') {
                    $holder_title = $row['holder']['first_name'] . ' ' . $row['holder']['last_name'];
                    if ($row['holder']['id'] == $identity['id']) {
                      $holder_subtitle = 'Pakon e ke ende ti';
                    } else if ($row['holder']['id'] == $row['sender']['id']) {
                      $holder_subtitle = 'Pakon e ka ende dërguesi';
                    } else if ($row['holder']['id'] == $row['recipient']['id']) {
                      $holder_subtitle = 'Pakon e ka marrë marrësi';
                    }
                  } else if ($row['holder']['type'] == 'courier') {
                    $holder_title = $row['holder']['first_name'] . ' ' . $row['holder']['last_name'];
                    $holder_subtitle = 'Pakon e ka korrieri';
                  } else if ($row['holder']['type'] == 'office') {
                    $holder_title = $row['holder']['name'];
                    $holder_subtitle = 'Pakoja në zyrë postare';
                  }
                  ?>
                  <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                      <div>
                          <div class="text-base font-normal"><?= $holder_title ?></div>
                          <div class="font-normal text-gray-500"><?= $holder_subtitle ?></div>
                      </div>  
                  </td>
                  <td scope="row" class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                  <?php if ($identity['identity_type'] == 'courier' || $identity['identity_type'] == 'employee') { ?>
                      <div id="tooltip-accept-delivery-<?= $delivery['tracking_number'] ?>" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                        Prano Dërgesën
                        <div class="tooltip-arrow" data-popper-arrow></div>
                      </div>
                      <a data-tooltip-target="tooltip-accept-delivery-<?= $delivery['tracking_number'] ?>" data-tooltip-style="light" href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                      </a>
                  <?php } ?>
                      
                      <div id="tooltip-track-delivery-<?= $delivery['tracking_number'] ?>" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                        Gjurmo Dërgesën
                        <div class="tooltip-arrow" data-popper-arrow></div>
                      </div>
                      <a data-tooltip-target="tooltip-track-delivery-<?= $delivery['tracking_number'] ?>" data-modal-target="tracking-history-modal-<?= $delivery['tracking_number'] ?>" data-modal-toggle="tracking-history-modal-<?= $row['tracking_number'] ?>" href="#" class="pl-4 font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                        </svg>
                      </a>

                      <div id="tooltip-edit-delivery-<?= $delivery['tracking_number'] ?>" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                        Ndrysho Dërgesën
                        <div class="tooltip-arrow" data-popper-arrow></div>
                      </div>
                      <a data-tooltip-target="tooltip-edit-delivery-<?= $delivery['tracking_number'] ?>" href="#" class="pl-4 font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                      </a>
                    </div>
                  </td>
              </tr>
            <?php
              }
            ?>
        </tbody>
    </table>
</div>

<script>
  const searchInput = document.querySelector('#table-search-delivery');
  const tableBody = document.querySelector('#table-deliveries-body');

  searchInput.addEventListener('input', () => {
    const searchQuery = searchInput.value.trim().toLowerCase();
    const rows = tableBody.querySelectorAll('tr');

    rows.forEach(row => {
      const cells = row.querySelectorAll('td, th');
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
