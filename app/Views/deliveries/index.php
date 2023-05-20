<?php include __DIR__ . '/../common/head.php'; ?>

<?php include __DIR__ . '/../common/nav.php'; ?>

<div class="p-4 sm:ml-64 mt-10 bg-white dark:bg-gray-900 h-100">

<?php
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter; 

function createQRCode($name, $content) {
  $qr = QrCode::create($content);
  $writer = new PngWriter();
  $filename = "assets/qr-codes/" . $name . ".png";

  if (!file_exists($filename)) {
    $writer->write($qr)->saveToFile($filename);
  }
}

function checkElgibleToAcceptDelivery($delivery, $identity)
{
    if ($delivery['status'] == 'created' && $identity['identity_type'] == 'courier') {
        return true;
    }
    if ($delivery['status'] == 'accepted' && $identity['identity_type'] == 'courier') {
        return true;
    }
    if ($delivery['status'] == 'picked_up' && $identity['identity_type'] == 'employee') {
        return true;
    }
    if ($delivery['status'] == 'in_post_office' && $identity['identity_type'] == 'courier') {
        return true;
    }
    if ($delivery['status'] == 'out_for_delivery' && $identity['id'] == $delivery['recipient']['id']) {
        return true;
    }
    return false;
}

?>


<?php include __DIR__ . '/create.php'; ?>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg my-4">
    <div class="flex items-center justify-between pb-4 bg-white dark:bg-gray-900">
        
        <div>
        <?php if ($identity['identity_type'] == 'user') { ?>
            <button data-modal-target="create-delivery-modal" data-modal-toggle="create-delivery-modal" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button">
              Krijo Dërgesë
            </button>
        <?php } ?>
        </div>
        <label for="table-search" class="sr-only">Kërko</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <input type="text" id="table-search-delivery" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Kërko për dërgesë">
        </div>
    </div>
    <?php
    foreach ($deliveries as $delivery) {
      // Include Modals
      include __DIR__ . '/qr-code.php';
      include __DIR__ . '/actions.php';
      include __DIR__ . '/accept-delivery.php';
      include __DIR__ . '/tracking-history.php';
      include __DIR__ . '/information.php';
    }
    ?>
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
              foreach ($deliveries as $delivery) {
                createQRCode($delivery['tracking_number'], $delivery['tracking_number']);
            ?>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <td class="w-4 p-4">
                      <div class="flex items-center">
                          <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                          <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                      </div>
                  </td>
                  <td class="px-6 py-4">
                      <a href="#" data-modal-target="qr-code-display-<?= $delivery['tracking_number'] ?>" data-modal-toggle="qr-code-display-<?= $delivery['tracking_number'] ?>"><?= $delivery['tracking_number'] ?></a>
                  </td>
                  <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                      <div>
                          <div class="text-base font-semibold"><?= $delivery['recipient']['first_name'] . ' ' .  $delivery['recipient']['last_name'] ?></div>
                          <div class="font-normal text-gray-500"><?= $delivery['recipient']['email'] ?></div>
                      </div>  
                  </th>
                  <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                      <div>
                          <div class="text-base font-normal"><?= $delivery['address']['street'] ?></div>
                          <div class="font-normal text-gray-500"><?= $delivery['address']['city'] . ' ' . $delivery['address']['zip'] ?></div>
                      </div>  
                  </td>
                  
                  <td class="px-6 py-4">
                      <div class="flex items-center">
                          <div class="h-2.5 w-2.5 rounded-full bg-<?= $delivery['status_display']['color'] ?>-500 mr-2"></div> <?= $delivery['status_display']['message'] ?>
                      </div>
                  </td>
                  <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                      <div>
                          <div class="text-base font-normal"><?= $delivery['holder']['title'] ?></div>
                          <div class="font-normal text-gray-500"><?= $delivery['holder']['subtitle'] ?></div>
                      </div>
                  </td>
                  <td scope="row" class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <button id="delivery-actions-<?= $delivery['tracking_number'] ?>-button" data-dropdown-toggle="delivery-actions-<?= $delivery['tracking_number'] ?>" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Veprime <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
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
