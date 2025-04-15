document.getElementById('searchInput').addEventListener('input', function() {
    const searchValue = this.value.toLowerCase();
    document.querySelectorAll('tbody tr').forEach((row) => {
        const clientName = row.querySelector('td:nth-child(2) .text-dark').textContent.toLowerCase();
        const brandName = row.querySelector('td:nth-child(1) .font-weight-semibold').textContent.toLowerCase();
        if (clientName.includes(searchValue) || brandName.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
document.querySelectorAll('input[name="btnradiotable"]').forEach((radio) => {
    radio.addEventListener('change', function() {
        const selectedValue = this.value;
        document.querySelectorAll('.client-item').forEach((item) => {
            const itemStatus = item.getAttribute('data-status');
            
            if (itemStatus == selectedValue || (selectedValue == 2 && itemStatus !== '1')) {
                item.style.display = 'block'; // Tampilkan item
            } else {
                item.style.display = 'none'; // Sembunyikan item
            }
        });
    });
});

function validateCheckboxes() {
    const checkboxes = document.querySelectorAll('input[name="layanan[]"]');
    const isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
    if (!isChecked) {
        alert('Silakan pilih minimal satu layanan.');
        return false; // Mencegah pengiriman formulir
    }
    return validateDates(); // Tambahkan validasi tanggal
}

function validateDates() {
    const tanggalAktif = document.getElementById('tanggal_aktif').value;
    const tanggalBerakhir = document.getElementById('tanggal_berakhir').value;
    if (tanggalBerakhir < tanggalAktif) {
        alert('Tanggal berakhir tidak boleh kurang dari tanggal aktif.');
        return false; // Mencegah pengiriman formulir
    }
    return true; // Mengizinkan pengiriman formulir
}
function validateCheckboxes() {
    const checkboxes = document.querySelectorAll('input[name="layanan[]"]');
    const isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
    if (!isChecked) {
        alert('Silakan pilih minimal satu layanan.');
        return false; // Mencegah pengiriman formulir
    }
    return true; // Mengizinkan pengiriman formulir
}
function searchByDate() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const dateCell = row.querySelector('.report-date span'); // Pastikan selector ini benar
        if (dateCell) {
            const dateText = dateCell.textContent || dateCell.innerText;
            row.style.display = dateText.toLowerCase().includes(filter) ? '' : 'none';
        }
    });
}

