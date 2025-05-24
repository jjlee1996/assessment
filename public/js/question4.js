document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('gachaForm');

    const rarityInput = document.getElementById('rarities');
    const vipInput = document.getElementById('vips');

    const rarityTooltip = document.getElementById('rarities-tooltip');
    const vipTooltip = document.getElementById('vips-tooltip');

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

    filterInputToDigits(rarityInput, rarityTooltip);
    filterInputToDigits(vipInput, vipTooltip);

form.addEventListener('submit', async function (e) {
    e.preventDefault();

    const maxRarities = parseInt(rarityInput.value, 10);
    const maxVips = parseInt(vipInput.value, 10);

    let rarities = [];
    if (!isNaN(maxRarities) && maxRarities > 0) {
        for (let i = 1; i <= maxRarities; i++) {
            rarities.push(i);
        }
    }

    let vips = [];
    if (!isNaN(maxVips) && maxVips > 0) {
        for (let i = 1; i <= maxVips; i++) {
            vips.push(`vip${i}`);
        }
    }

    const params = [
        ...rarities.map(r => `rarities[]=${encodeURIComponent(r)}`),
        ...vips.map(v => `vips[]=${encodeURIComponent(v)}`)
    ].join('&');

    try {
        const response = await fetch(`/simulate?${params}`);
        const result = await response.json();

        const resultDiv = document.getElementById('results');
        resultDiv.innerHTML = '<pre>' + JSON.stringify(result, null, 2) + '</pre>';
    } catch (error) {
        console.error('Simulation error:', error);
        alert('An error occurred while simulating.');
    }
});

});
