document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('analyzeForm');
    const sendInput = document.getElementById('send');
    const receiveInput = document.getElementById('receive');

    const sendTooltip = document.getElementById('send-tooltip');
    const receiveTooltip = document.getElementById('receive-tooltip');

        function showTooltip(tooltip) {
        tooltip.style.display = 'inline';
        setTimeout(() => {
            tooltip.style.display = 'none';
        }, 2000);
    }

        // Live input filter: allow digits only
    function filterInputToDigits(inputElement, tooltipElement) {
        inputElement.addEventListener('input', function (e) {
            const originalValue = this.value;
            const filteredValue = originalValue.replace(/\D/g, '');

            if (originalValue !== filteredValue) {
                showTooltip(tooltipElement);
                this.value = filteredValue;
            }
        });
    }

    filterInputToDigits(sendInput, sendTooltip);
    filterInputToDigits(receiveInput, receiveTooltip);

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const send = sendInput.value;
        const receive = receiveInput.value;

        console.log(`Sends message: ${send}`);

        console.log(`Receives message: ${receive}`);

        fetch(`/analyze/${send}/${receive}`, {
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