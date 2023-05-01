
<?php foreach ($deliveries as $delivery) { ?>
<div id="tracking-history-modal-<?= $delivery['tracking_number'] ?>" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Gjurmimi i Dërgesës (<?= $delivery['tracking_number'] ?>)
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="tracking-history-modal-<?= $delivery['tracking_number'] ?>">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Ora
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Përshkrimi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Vendodhja e Pakos
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($delivery['tracking_history'] as $tracking_history_item) {
                            
                            $holder_title = "S'ka informacion";
                            $holder_subtitle = "";
                            if ($tracking_history_item['holder']['type'] == 'user') {
                                $holder_title = $tracking_history_item['holder']['first_name'] . ' ' . $tracking_history_item['holder']['last_name'];
                                if ($tracking_history_item['holder']['id'] == $identity['id']) {
                                    $holder_subtitle = 'ti';
                                } else if ($tracking_history_item['holder']['id'] == $row['sender']['id']) {
                                    $holder_subtitle = 'Dërguesi';
                                } else if ($tracking_history_item['holder']['id'] == $row['recipient']['id']) {
                                    $holder_subtitle = 'Marrësi';
                                }
                            } else if ($tracking_history_item['holder']['type'] == 'courier') {
                                $holder_title = $tracking_history_item['holder']['first_name'] . ' ' . $tracking_history_item['holder']['last_name'];
                                $holder_subtitle = 'Korrieri';
                            } else if ($tracking_history_item['holder']['type'] == 'office') {
                                $holder_title = $tracking_history_item['holder']['name'];
                                $holder_subtitle = 'Zyra Postare';
                            }
                            
                        ?>

                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?= $tracking_history_item['created_at'] ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?= $tracking_history_item['description'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $holder_title . ' (' . $holder_subtitle . ')' ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php } ?>