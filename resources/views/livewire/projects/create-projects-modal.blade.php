<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-xl">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">
        ✅ Modal Test Successful!
    </h3>

    <p class="text-gray-600 dark:text-gray-400 mb-6">
        {{ $message }} This confirms Wire Elements Modal is working correctly.
    </p>

    <button 
        wire:click="$dispatch('closeModal')" 
        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-150"
    >
        Close Modal
    </button>
</div>