<div id="qr-code-display-<?= $delivery['tracking_number'] ?>" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="qr-code-display-<?= $delivery['tracking_number'] ?>">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <div class="my-2">
                    <img class="w-full" src="assets/qr-codes/<?= $delivery['tracking_number'] ?>.png" alt="">
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <span class="border-b w-1/5 lg:w-1/2"></span>
                    <p class="mx-2 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">Barcode</p>
                    <span class="border-b w-1/5 lg:w-1/2"></span>
                </div>
                <div class="bg-white p-2 my-2">
                    <img class="w-full" src="assets/barcodes/<?= $delivery['tracking_number'] ?>.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>