<?php
include("../../config/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id = $_POST["id"];

    // Menonaktifkan sementara FK checks
    $disable_fk = "SET foreign_key_checks = 0;";
    mysqli_query($mysqli, $disable_fk);

    // Query untuk menghapus data dokter
    $query = "DELETE FROM dokter WHERE id = $id";

    // Eksekusi query
    if (mysqli_query($mysqli, $query)) {
        // Jika berhasil, redirect kembali ke halaman index atau sesuaikan dengan kebutuhan Anda
        echo '<script>';
        echo 'alert("Data dokter berhasil dihapus!");';
        echo 'window.location.href = "../../dokter.php";';
        echo '</script>';
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }

    // Mengaktifkan kembali FK checks
    $enable_fk = "SET foreign_key_checks = 1;";
    mysqli_query($mysqli, $enable_fk);
}

// Tutup koneksi
mysqli_close($mysqli);
?>
