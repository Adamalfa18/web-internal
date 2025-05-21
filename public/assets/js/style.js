// // Fungsi hitung dan update ROAS Bulanan MB
// function calculateRoasBulananMB() {
//     const spanInput = document.getElementById('targetSpentnBulananMB');
//     const revenueInput = document.getElementById('targetRevenueBulananMB');
//     const roasInput = document.getElementById('targetRoasBulananMB');

//     const spanValue = parseFloat(spanInput.value) || 0;
//     const revenueValue = parseFloat(revenueInput.value) || 0;
//     let roasValue = 0;

//     if (revenueValue !== 0) {
//         roasValue = revenueValue / spanValue;
//     }

//     // Update hasil ke input Target Roas
//     if (roasInput) {
//         roasInput.value = roasValue.toFixed(2);
//     }
// }

// // Menambahkan event listener untuk update ROAS Bulanan MB
// document.addEventListener('DOMContentLoaded', function () {
//     const spanInputMB = document.getElementById('targetSpentnBulananMB');
//     const revenueInputMB = document.getElementById('targetRevenueBulananMB');

//     if (spanInputMB && revenueInputMB) {
//         spanInputMB.addEventListener('input', calculateRoasBulananMB);
//         revenueInputMB.addEventListener('input', calculateRoasBulananMB);
//     }
// });

// Event listener untuk search input
document.getElementById("searchInput").addEventListener("input", function () {
    const searchValue = this.value.toLowerCase();
    document.querySelectorAll("tbody tr").forEach((row) => {
        const clientName = row
            .querySelector("td:nth-child(2) .text-dark")
            .textContent.toLowerCase();
        const brandName = row
            .querySelector("td:nth-child(1) .font-weight-semibold")
            .textContent.toLowerCase();
        row.style.display =
            clientName.includes(searchValue) || brandName.includes(searchValue)
                ? ""
                : "none";
    });
});

// Event listener untuk radio buttons
document.querySelectorAll('input[name="btnradiotable"]').forEach((radio) => {
    radio.addEventListener("change", function () {
        const selectedValue = this.value;
        document.querySelectorAll(".client-item").forEach((item) => {
            const itemStatus = item.getAttribute("data-status");
            item.style.display =
                itemStatus == selectedValue ||
                (selectedValue == 2 && itemStatus !== "1")
                    ? "block"
                    : "none";
        });
    });
});

// Fungsi validasi checkbox layanan
function validateCheckboxes() {
    const checkboxes = document.querySelectorAll('input[name="layanan[]"]');
    const isChecked = Array.from(checkboxes).some(
        (checkbox) => checkbox.checked
    );
    if (!isChecked) {
        alert("Silakan pilih minimal satu layanan.");
        return false;
    }
    return validateDates(); // Validasi tanggal
}

// Fungsi validasi tanggal
function validateDates() {
    const tanggalAktif = document.getElementById("tanggal_aktif").value;
    const tanggalBerakhir = document.getElementById("tanggal_berakhir").value;
    if (tanggalBerakhir < tanggalAktif) {
        alert("Tanggal berakhir tidak boleh kurang dari tanggal aktif.");
        return false;
    }
    return true;
}

// Fungsi untuk mencari berdasarkan tanggal
function searchByDate() {
    const input = document.getElementById("searchInput");
    const filter = input.value.toLowerCase();
    const rows = document.querySelectorAll("tbody tr");

    rows.forEach((row) => {
        const dateCell = row.querySelector(".report-date span");
        if (dateCell) {
            const dateText = dateCell.textContent || dateCell.innerText;
            row.style.display = dateText.toLowerCase().includes(filter)
                ? ""
                : "none";
        }
    });
}
