// public/js/script.js

function saveData() {
    if (data.length > 0) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        axios.post('/save-data', {
            _token: csrfToken,
            data: data
        })
        .then(response => {
            if (response.data.success) {
                alert('Data berhasil disimpan ke database!');
                data = []; // Reset array data setelah data disimpan
                // clearTable();
            }
        })
        .catch(error => {
            console.error(error);
        });
    } else {
        alert('Tidak ada data untuk disimpan!');
    }
}
