const rates = {
    BHD: { USD: 2.65, EUR: 2.23, JPY: 391.17, IDR: 37985.00, BHD: 1 },
    USD: { BHD: 0.38, EUR: 0.84, JPY: 147.56, IDR: 14300.00, USD: 1 },
    EUR: { BHD: 0.45, USD: 1.19, JPY: 175.30, IDR: 17000.00, EUR: 1 },
    JPY: { BHD: 0.0026, USD: 0.0068, EUR: 0.0057, IDR: 97.00, JPY: 1 },
    IDR: { BHD: 0.000026, USD: 0.00007, EUR: 0.000059, JPY: 0.0103, IDR: 1 }
};

function convert() {
    const amount = document.getElementById("amount").value;
    const fromCurrency = document.getElementById("fromCurrency").value;
    const toCurrency = document.getElementById("toCurrency").value;

    if (amount === "" || isNaN(amount)) {
        alert("Silakan masukkan jumlah yang valid");
        return;
    }

    const rate = rates[fromCurrency][toCurrency];
    const result = amount * rate;

    document.getElementById("result").innerHTML = `${amount} ${fromCurrency} = ${result.toFixed(2)} ${toCurrency}`;
}
