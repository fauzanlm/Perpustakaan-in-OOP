<?php
include "config/koneksi.php";
include "library/oop.php";


$go = new oop();
$tabel = 'login_user';
@$username = $_POST['username'];
@$password = base64_encode(@$_POST['password']);
@$redirect = 'dashboard.php';

if(isset($_POST['login'])){

	$go->login($con, $tabel, $username, $password, $redirect);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	
    <link rel="icon" href="logo/logowk.png">
	<title>Halaman Login</title>
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
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
    }
    .register-box h1{
        float: left;
        font-size: 40px;
        border-bottom: 6px solid #fff600;
        margin-bottom: 30px;
        padding: 13px 0;
    }
    .textbox{
        width: 100%;
        overflow: hidden;
        font-size: 15px;
        padding: 7px 0;
        margin: 7px 0;
        border-bottom: 1px solid #fff600;
    }
    .textbox input{
        border: none;
        outline: none;
        background: none;
        color: white;
        font-size: 18px;
        width: 80px;
        float: left;
        margin: 10px;
    }
    /* .textbox i{
        width: 26px;
        float: left;
        text-align: center;
    } */
    .btn{
        width: 100%;
        background:none;
        border: 2px solid #fff600;
        color: yellow;
        padding: 5px;
        font-size: 18px;
        cursor: pointer;
        margin: 12px 0;
    }
	.abc{
        width: 100%;
        background:none;
        
        color: magenta;
        padding: 5px;
        font-size: 18px;
        cursor: pointer;
        margin: 12px 0;
    }
	</style>
</head>
<body>

	<?php if(isset($error)) : ?>
		<p style="color : red; font-style: italic;">
			Username atau Password salah
		</p>
	<?php endif; ?>

	<form action="" method="post">
	<div class="register-box">
    <h1>Login Perpustakaan</h1>
    <div class="textbox">
    <i class="fa fa-user" aria-hidden="true"></i>
    <input type="text" placeholder="Username" name="username" value="" id="username" required>
    </div>

    <div class="textbox">
    <i class="fa fa-lock" aria-hidden="true"></i>
    <input type="password" placeholder="Password" name="password" value="" id="password" required>
    </div>

    <input type="submit" class="btn" name="login" value="LOGIN">
	<br>
	<a class="abc" href="registrasi.php">Sign up</a>
    </div>
		<!-- <ul>
			<li>
				<label for="username">username :</label>
				<input type="text" name="username" id="username">
			</li>
			<li>
				<label for="password">password :</label>
				<input type="password" name="password" id="password">
			</li>
			<li>
				<button type="submit" name="login">login</button>
			</li>
		</ul>
		<a href="registrasi.php">Sign up</a> -->

	</form>

</body>
</html>