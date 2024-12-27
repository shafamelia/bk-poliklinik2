<?php
    session_start();
    require '../../config/koneksi.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password']; 

        // Query untuk mencari data pasien berdasarkan username dan password
        $query = "SELECT * FROM pasien WHERE nama = '$username' AND password = '$password'";
        $result = mysqli_query($mysqli, $query);
        
        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);

            // Menyimpan data ke dalam session
            $_SESSION['id'] = $data['id'];
            $_SESSION['username'] = $data['nama'];
            $_SESSION['password'] = $data['password'];
            $_SESSION['no_rm'] = $data['no_rm'];
            $_SESSION['akses'] = "pasien";

            // Redirect ke dashboard pasien
            header("location:../../dashboard_pasien.php");
        }
        else {
            // Menampilkan pesan jika username atau password salah
            echo '<script>alert("Username atau password salah"); location.href="../../loginUser.php";</script>';
        }
    }
?>
