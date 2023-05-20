<div id="delivery-actions-<?= $delivery['tracking_number'] ?>" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-72 dark:bg-gray-700 dark:divide-gray-600">
    <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="delivery-actions-<?= $delivery['tracking_number'] ?>-button">
        <?php if (checkElgibleToAcceptDelivery($delivery, $identity)) { ?>
        <li>
            <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <label data-modal-target="accept-delivery-<?= $delivery['tracking_number'] ?>-modal" data-modal-toggle="accept-delivery-<?= $delivery['tracking_number'] ?>-modal" class="relative inline-flex items-center w-full cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Prano Dërgesën</span>
                </label>
            </div>
        </li>
        <?php } ?>

        <li>
            <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <label data-modal-target="delivery-information-modal-<?= $delivery['tracking_number'] ?>" data-modal-toggle="delivery-information-modal-<?= $delivery['tracking_number'] ?>" class="relative inline-flex items-center w-full cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                    </svg>  
                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Informacion mbi Dërgesën</span>
                </label>
            </div>
        </li>
    
        <li>
            <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <label data-modal-target="tracking-history-modal-<?= $delivery['tracking_number'] ?>" data-modal-toggle="tracking-history-modal-<?= $delivery['tracking_number'] ?>" class="relative inline-flex items-center w-full cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                    </svg>  
                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Gjurmo Dërgesën</span>
                </label>
            </div>
        </li>

      
    </ul>
</div>