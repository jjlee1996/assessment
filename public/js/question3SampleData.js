const sampleData = [
    ['Annie', 'FEMALE', 70, 50],
    ['Max', 'MALE', 20, 70],
    ['Tom', 'MALE', 40, 30]
];

document.getElementById('fillSample').addEventListener('click', () => {
    const tbody = document.querySelector('#studentTable tbody');

    tbody.innerHTML = '';

    sampleData.forEach((student, index) => {
        const tr = document.createElement('tr');
        tr.classList.add('student-row');

        tr.innerHTML = `
            <td data-label="Name">
                <input type="text" name="students[${index}][name]" required value="${student[0]}">
            </td>
            <td data-label="Gender">
                <select name="students[${index}][gender]" required>
                    <option value="">Select</option>
                    <option value="MALE" ${student[1] === 'MALE' ? 'selected' : ''}>Male</option>
                    <option value="FEMALE" ${student[1] === 'FEMALE' ? 'selected' : ''}>Female</option>
                </select>
            </td>
            <td data-label="Math">
                <input type="number" name="students[${index}][math]" min="0" max="100" required value="${student[2]}">
            </td>
            <td data-label="Science">
                <input type="number" name="students[${index}][science]" min="0" max="100" required value="${student[3]}">
            </td>
            <td data-label="Action">
                <button type="button" class="remove">Remove</button>
            </td>
        `;
        tbody.appendChild(tr);
    });
});