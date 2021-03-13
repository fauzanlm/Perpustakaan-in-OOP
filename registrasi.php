<?php

include "config/koneksi.php";
include "library/oop.php";


$go = new oop();
$tabel = 'login_user';
$field = array(
    'username' => @$_POST['username'],
    'password' => base64_encode(@$_POST['password'] ));
$username = @$_POST['username'];
@$redirect = 'index.php';

$cek = mysqli_query($con,"SELECT username FROM $tabel WHERE username = '$username'");

if(mysqli_fetch_assoc($cek)){
    echo "<script>alert('Username Sudah Ada');document.localition.href='$redirect'</script>";            
}
else if(@$_POST['password'] != @$_POST['konfirmasiPassword']){
    echo "<script>alert('Password Tidak Sesuai');document.localition.href='registrasi.php'</script>";
    echo "<script>alert('Data gagal Ditambahkan');document.localition.href='registrasi.php'</script>";
}else{
    if(isset($_POST['simpan'])){
        $go->simpan($con, $tabel, $field, $redirect);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Registrasi User</title>
    <link rel="icon" href="logo/logowk.png">
    <style>
		label{
		display:block;
	}
	@import "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css";
    body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        background: url(img/bg.jpg) no-repeat;
        background-size: cover;
    }
    .register-box {
        width: 280px;
        position: absolute;
        top: 10%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
    }
    .txt{
        color:white;
        margin-top:2px;
    }
    #toggle{
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
        width: 30px;
        height: 30px;
        background: url(logo/h_s/show.png);
        background-size: cover;
        cursor: pointer;
    }
    #toggle.hide{
        background: url(logo/h_s/hide.png);
        background-size: cover;
    }
	</style>    
</head>
<body>
    <br>
    <br>
    <br><br>
    <div class="register-box">
        <h2 align="center"><b>MENU REGISTRASI</b></h2>
    </div>
    <br>
    <form method='post'>
    <div class="container">
        <tr>
            <td><h5 class="txt">Username</h5></td>
            <td></td>
            <td><input class="form-control me-2" placeholder="Username..." type="text" name="username" value="<?php echo @$edit['username'] ?>" required></td>
        </tr>
        <tr>
            <td><h5 class="txt">Password</h5></td>
            <td></td>
            <td><input class="form-control me-2" placeholder="Password..." type="password" name="password" value="<?php echo base64_decode(@$edit['password']) ?>" required></td>
            <div id="toggle" onclick="showHide();"></div></td>
        </tr>
        <tr>
            <td><h5 class="txt">Konfirmasi Password</h5></td>
            <td></td>
            <td><input class="form-control me-2" placeholder="Konfirmasi Password..." type="password" name="konfirmasiPassword" value="<?php echo base64_decode(@$edit['password']) ?>" required></td>
        </tr>
        
        <tr>
            <td></td>
            <td></td>
            <td>
                <?php if(@$_GET['id']=="") { ?>
                <input class="btn btn-primary mt-2" type="submit" name="simpan" value="SIMPAN">
                <?php }else{ ?>
                <input class="btn btn-success mt-2" type="submit" name="ubah" value="UPDATE">
                <?php } ?>
                <a href="index.php" class="btn btn-warning mt-2">KEMBALI</a>
            </td>
        </tr>
    </div>
    </form>
    
</body>
</html>