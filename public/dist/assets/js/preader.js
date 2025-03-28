document.addEventListener('DOMContentLoaded', function () {
    function getSkuNoPlaceholders() {
        let prefix = document.getElementById('RSkuBrnName').value;
        let code = document.getElementById('RSkuName2').value;
        let shortPrefix = prefix.substring(0, 2).toUpperCase();
        document.getElementById('RSkuNo').value = `${shortPrefix} ${code}`;
    }

    function verifyPricePlaceholders(){
        let priceInput = document.getElementById('RSkuPrice');

        let value = priceInput.value.replace(/[^0-9.]/g, '');

        if ((value.match(/\./g) || []).length > 1) {
            value = value.slice(0, -1);
        }

        value = value.replace(/(\.\d{2})\d+/, '$1');
        priceInput.value = value;
    }

    getSkuNoPlaceholders();
    document.getElementById('RSkuBrnName').addEventListener('input', getSkuNoPlaceholders);
    document.getElementById('RSkuName2').addEventListener('input', getSkuNoPlaceholders);

    verifyPricePlaceholders();
    document.getElementById('RSkuPrice').addEventListener('input', verifyPricePlaceholders);
});
