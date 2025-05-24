document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('downloadForm');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const memberType = document.getElementById('memberType').value;
        const fileType = document.getElementById('fileType').value;

        console.log(`Member type: ${memberType}`);

        console.log(`File type: ${fileType}`);

        fetch(`/download/${memberType}/${fileType}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(data => {
            console.log(`Result: ${data}`);
            document.getElementById('result').textContent = data;
        });

        
    });
});