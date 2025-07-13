document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('student-search');
    const table = document.getElementById('student-table');
    const tbody = document.getElementById('student-body');
    const selectAllCheckbox = document.getElementById('select-all');

    // Jika element tidak ada (misalnya di halaman lain), keluar dari function
    if (!searchInput || !table || !tbody || !selectAllCheckbox) {
        return;
    }

    let rows = Array.from(tbody.querySelectorAll('tr'));
    let sortDirection = 1;

    function filterRows() {
        const keyword = searchInput.value.toLowerCase();
        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(keyword) ? '' : 'none';
        });
    }

    function sortRows(columnIndex) {
        const visibleRows = rows.filter(row => row.style.display !== 'none');

        visibleRows.sort((a, b) => {
            const aText = a.children[columnIndex].innerText.trim().toLowerCase();
            const bText = b.children[columnIndex].innerText.trim().toLowerCase();
            return aText.localeCompare(bText) * sortDirection;
        });

        sortDirection *= -1;
        tbody.innerHTML = '';

        // Append visible sorted rows first
        visibleRows.forEach(row => tbody.appendChild(row));

        // Append hidden rows back (unchanged)
        rows.filter(row => row.style.display === 'none').forEach(row => tbody.appendChild(row));
    }

    searchInput.addEventListener('input', filterRows);

    table.querySelectorAll('th[data-sort]').forEach((th, index) => {
        th.addEventListener('click', () => {
            sortRows(index);
        });
    });

    selectAllCheckbox.addEventListener('change', () => {
        const visibleCheckboxes = tbody.querySelectorAll('tr:not([style*="display: none"]) .row-checkbox');
        visibleCheckboxes.forEach(cb => cb.checked = selectAllCheckbox.checked);
    });
});