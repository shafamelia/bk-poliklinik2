<?php
    session_start();
    require '../../config/koneksi.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password']; 

        // Cek kredensial admin
        if ($username == "admin" && $password == "admin") {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['akses'] = "admin";

            header("location:../../dashboard_admin.php");
        }
        else{
            // Cek kredensial user (dokter) di database
            $query = "SELECT * FROM dokter WHERE nama = '$username' AND password = '$password'";
            $result = mysqli_query($mysqli, $query);
            if (mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_assoc($result);

                $_SESSION['id'] = $data['id'];
                $_SESSION['username'] = $data['nama'];
                $_SESSION['password'] = $data['password'];
                $_SESSION['id_poli'] = $data['id_poli'];
                $_SESSION['akses'] = "dokter";

                header("location:../../dashboard_dokter.php");
            }
            else{
                echo '<script>alert("Username atau password salah"); location.href="../../login.php";</script>';
            }
        }
    }
?>
