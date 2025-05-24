let rowIndex = 1;

document.getElementById('addRow').addEventListener('click', () => {
    const tableBody = document.querySelector('#studentTable tbody');
    const newRow = document.createElement('tr');
    newRow.className = 'student-row';
    newRow.innerHTML = `
        <td data-label="Name"><input type="text" name="students[${rowIndex}][name]" required></td>
        <td data-label="Gender">
            <select name="students[${rowIndex}][gender]" required>
                <option value="">Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </td>
        <td data-label="Math"><input type="number" name="students[${rowIndex}][math]" min="0" max="100" required></td>
        <td data-label="Science"><input type="number" name="students[${rowIndex}][science]" min="0" max="100" required></td>
        <td data-label="Action"><button type="button" class="remove">Remove</button></td>
    `;
    tableBody.appendChild(newRow);
    rowIndex++;
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove')) {
        e.target.closest('tr').remove();
    }
});
