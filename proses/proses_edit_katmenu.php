<?php
include "connect.php";
$id = (isset($_POST['id_kat_menu'])) ? htmlentities($_POST['id_kat_menu']) : "";
$jenismenu = (isset($_POST['jenismenu'])) ? htmlentities($_POST['jenismenu']) : "";
$katmenu = (isset($_POST['katmenu'])) ? htmlentities($_POST['katmenu']) : "";

$message = ""; // Initialize the message variable

if (!empty($_POST['edit_katmenu_validate'])) {
    // Query to check if the category already exists
    $select = mysqli_query($conn, "SELECT kategori_menu FROM tb_kategori_menu WHERE kategori_menu = '$katmenu' AND id_kat_menu != '$id'");
    
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Kategori menu yang dimasukkan telah ada");
                    window.location="../katmenu"</script>';
    } else {
        // Query to update category data
        $query = mysqli_query($conn, "UPDATE tb_kategori_menu SET jenis_menu='$jenismenu', 
        kategori_menu='$katmenu' WHERE id_kat_menu='$id'");
        
        if ($query) {
            $message = '<script>alert("Data berhasil diupdate");
                    window.location="../katmenu"</script>';
        } else {
            $message = '<script>alert("Data gagal diupdate");
                    window.location="../katmenu"</script>';
        }
    }
}
echo $message;
?>
