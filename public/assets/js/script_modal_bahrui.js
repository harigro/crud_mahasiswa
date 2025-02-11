document.addEventListener("DOMContentLoaded", function () {
    // Dapatkan semua tombol "Bahrui"
    document.querySelectorAll("button[data-bs-target='#modalBahrui']").forEach(button => {
        button.addEventListener("click", function () {
            // Cari elemen input tersembunyi di dalam baris yang sesuai
            let parentRow = this.closest("tr");
            //  Ambil nilai dari input yang tersebunyi
            let idValue = parentRow.querySelector(".data-id").value;
            let namaValue = parentRow.querySelector(".data-nama").value;
            let nimValue = parentRow.querySelector(".data-nim").value;
            let jurusanValue = parentRow.querySelector(".data-jurusan").value;
            let emailValue = parentRow.querySelector(".data-email").value;
            
            // Masukkan nilai ID ke dalam modal update
            document.querySelector("#modalBahrui input[name='id']").value = idValue;
            document.querySelector("#modalBahrui input[name='nama']").value = namaValue;
            document.querySelector("#modalBahrui input[name='nim']").value = nimValue;
            document.querySelector("#modalBahrui input[name='jurusan']").value = jurusanValue;
            document.querySelector("#modalBahrui input[name='email']").value = emailValue;
        });
    });
});
