<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$name = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : "";
$no_hp = (isset($_POST['no_hp'])) ? htmlentities($_POST['no_hp']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";

$message = ""; // Initialize the message variable

if (!empty($_POST['input_user_validate'])) {
    // Query to check if the username already exists, excluding the current user's username
    $select = mysqli_query($conn, "SELECT * FROM tb_user WHERE username='$username' AND id != '$id'");
    
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Username yang dimasukkan telah ada");
                    window.location="../user"</script>';
    } else {
        // Query to update user data
        $query = mysqli_query($conn, "UPDATE tb_user SET nama='$name', username='$username', level='$level', no_hp='$no_hp', alamat='$alamat' WHERE id='$id'");
        
        if ($query) {
            $message = '<script>alert("Data berhasil diupdate");
                    window.location="../user"</script>';
        } else {
            $message = '<script>alert("Data gagal diupdate");
                    window.location="../user"</script>';
        }
    }
}

echo $message;
?>
