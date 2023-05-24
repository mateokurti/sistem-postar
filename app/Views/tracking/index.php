<?php include __DIR__ . '/../common/head.php'; ?>


<div class="p-4 bg-white dark:bg-gray-900 h-100">
    <form class="flex items-center" method="GET">   
        <label for="tracking-search" class="sr-only">Gjurmo</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <input type="text" id="tracking-search" name="tracking_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Numri i Gjurmimit" required>
        </div>
        <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <span class="sr-only">Kërko Dërgesë</span>
        </button>
    </form>

    <ol class="block sm:hidden my-5 items-center sm:flex">
        <?php
            if (isset($delivery['tracking_history'])) {
                foreach ($delivery['tracking_history'] as $tracking_history_item) {
        ?>
        <li class="relative mb-6 sm:mb-0">
            <div class="flex items-center">
                <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                    <svg aria-hidden="true" class="w-3 h-3 text-blue-800 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                </div>
                <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
            </div>
            <div class="mt-3 sm:pr-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white"><?= $tracking_history_item['holder']['subtitle'] ?></h3>
                <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"><?= $tracking_history_item['created_at'] ?></time>
                <p class="text-base font-normal text-gray-500 dark:text-gray-400"><?= $tracking_history_item['holder']['title'] ?></p>
            </div>
        </li>
        <?php }} ?>
    </ol>

    <table class="hidden sm:table w-full my-5 text-sm text-left text-gray-500 dark:text-gray-400">
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
                if (isset($delivery['tracking_history'])) {
                    foreach ($delivery['tracking_history'] as $tracking_history_item) {
            ?>

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?= $tracking_history_item['created_at'] ?>
                    </th>
                    <td class="px-6 py-4">
                        <?= $tracking_history_item['description'] ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= $tracking_history_item['holder']['title'] . ' (' . $tracking_history_item['holder']['subtitle'] . ')' ?>
                    </td>
                </tr>
            <?php }} ?>
        </tbody>
    </table>
</div>


<?php include __DIR__ . '/../common/footer.php'; ?>