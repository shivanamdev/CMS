<script>
function confirmDelete(button) {
    const form = button.closest('form');

    // Create overlay
    const overlay = document.createElement('div');
    overlay.classList.add('fixed','inset-0','bg-black','bg-opacity-50','flex','items-center','justify-center','z-50');

    // Create popup
    const popup = document.createElement('div');
    popup.classList.add('bg-white','dark:bg-gray-900','rounded-lg','shadow-lg','p-6','w-96','text-center','space-y-4');

    popup.innerHTML = `
        <h2 class="text-lg font-bold text-gray-800 dark:text-white">Are you sure?</h2>
        <p class="text-gray-600 dark:text-gray-300">You Want to Delete this!</p>
        <div class="flex justify-center gap-4 mt-4">
            <button id="cancelBtn" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded">Cancel</button>
            <button id="confirmBtn" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">Delete</button>
        </div>
    `;

    overlay.appendChild(popup);
    document.body.appendChild(overlay);

    document.getElementById('cancelBtn').onclick = () => document.body.removeChild(overlay);

    document.getElementById('confirmBtn').onclick = () => {
        document.body.removeChild(overlay);
        form.submit(); // Submit the form
    };
}
</script>