<?php
include '../../config/koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $idPoli = $_SESSION['id_poli'];
    $idDokter = $_SESSION['id'];
    $hari = $_POST["hari"];
    $jamMulai = $_POST["jamMulai"];
    $jamSelesai = $_POST["jamSelesai"];

    // Periksa apakah dokter sudah memiliki jadwal pada hari yang sama
    $queryCekHari = "SELECT * FROM jadwal_periksa WHERE id_dokter = '$idDokter' AND hari = '$hari'";
    $resultCekHari = mysqli_query($mysqli, $queryCekHari);

    if (mysqli_num_rows($resultCekHari) > 0) {
        // Jika sudah ada jadwal pada hari yang sama, tampilkan pesan error
        echo '<script>alert("Dokter ini sudah memiliki jadwal pada hari yang sama.");window.location.href="../../jadwalPeriksa.php";</script>';
    } else {
        // Jika tidak ada konflik jadwal, tambahkan jadwal baru ke database
        $query = "INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai) VALUES ('$idDokter', '$hari', '$jamMulai', '$jamSelesai')";

        if (mysqli_query($mysqli, $query)) {
            // Jika berhasil, redirect kembali ke halaman utama atau sesuaikan dengan kebutuhan Anda
            echo '<script>alert("Jadwal berhasil ditambahkan!");window.location.href="../../jadwalPeriksa.php";</script>';
            exit();
        } else {
            // Jika terjadi kesalahan, tampilkan pesan error
            echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
        }
    }
}

// Tutup koneksi
mysqli_close($mysqli);
?>
