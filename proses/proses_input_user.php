<?php
include "connect.php";
$name = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : "";
$no_hp = (isset($_POST['no_hp'])) ? htmlentities($_POST['no_hp']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";
$password = md5('password');

if (!empty($_POST['input_user_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Username yang dimasukkan telah ada");
                    window.location="../user"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_user (nama,username,level,no_hp,alamat,password) values ('$name','$username','$level','$no_hp','$alamat','$password')");
        if ($query) {
            $message = '<script>alert("Data berhasil dimasukkan");
                    window.location="../user"</script>';
        } else {
            $message = '<script>alert("Data gagal dimasukkan")</script>';
        }
    }
}
echo $message;
