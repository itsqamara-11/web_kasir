<?php
session_start();
include "connect.php";
$nama = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$no_hp = (isset($_POST['no_hp'])) ? htmlentities($_POST['no_hp']): "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";

if (!empty($_POST['ubah_profile_validate'])) {
            $query = mysqli_query($conn, "UPDATE tb_user SET nama='$nama', no_hp='$no_hp', alamat='$alamat' WHERE username = '$_SESSION[username_cozcafe]'");
            if ($query) {
                $message = '<script>alert("Profile berhasil diupdate")
                window.history.back()</script>';
            }else{
                $message = '<script>alert("Profile gagal diupdate")
                window.history.back()</script>';
        }          
        }else{
            $message = '<script>alert("Terjadi kesalahan")
            window.history.back()</script>';
        }
echo $message;
?>