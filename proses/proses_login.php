<?php
session_start();
include "connect.php";
    $username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "" ;
    $password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password'])) : "" ;
    if(!empty($_POST['submit_validate'])){
        $query = mysqli_query($conn,"SELECT * FROM tb_user WHERE username = '$username' && password = '$password'");
        $hasil = mysqli_fetch_array($query);
        if($hasil){
            $_SESSION['username_cozcafe'] = $username;
            $_SESSION['level_cozcafe'] = $hasil['level'];
            $_SESSION['id_cozcafe'] = $hasil['id'];
            header('location:../home');
        }else{ ?>
            <script>
                alert('Username atau password yang anda masukan salah');
                window.location='../login'
            </script>
<?php
        }
    }
?>