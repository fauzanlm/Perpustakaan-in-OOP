<?php 

class oop{
	
	function login($con, $tabel, $username, $password, $redirect){
		session_start();

		$sql = "SELECT * FROM $tabel WHERE username='$username' and password='$password' ";
		$jalan = mysqli_query($con,$sql);

		$cek = mysqli_num_rows($jalan); //hasil 0 atau 1


		if($cek > 0){
			$_SESSION['user'] = $username;

		echo "<script>alert('Selamat datang $username');document.location.href='$redirect'</script>";
		}else{
			echo "<script>alert('username & password salah!');document.location.href='index.php'</script>";
		}
    }

    function simpan($con, $tabel, array $field, $redirect){
        $sql = "INSERT INTO $tabel SET ";

        foreach($field as $key =>$value){
            $sql.=" $key = '$value',";
        }

        $sql = rtrim($sql,',');
        $jalan = mysqli_query($con,$sql);
        
        if($jalan){
            echo "<script>alert('Data berhasil disimpan');document.localition.href='$redirect'</script>";
        }else{
            echo "<script>alert('Gagal disimpan');document.localition.href='$redirect'</script>";
        }


    }

    function tampilEdit($con, $tabel, $where){
        $sql ="SELECT * FROM $tabel WHERE $where";
        $jalan = mysqli_query($con, $sql);
        while($data = mysqli_fetch_assoc($jalan))
            $isi[] = $data;
        return @$isi;
    }

    function tampil($con, $tabel){
        $sql ="SELECT * FROM $tabel";
        $jalan = mysqli_query($con, $sql);
        while($data = mysqli_fetch_assoc($jalan))
            $isi[] = $data;
        return @$isi;
    }
    
    function hapus($con, $tabel, $where, $redirect){
        $sql = "DELETE FROM $tabel WHERE $where";
        $jalan = mysqli_query($con, $sql);
        if($jalan){
            echo "<script>alert('Data berhasil dihapus');document.localition.href='$redirect'</script>";
        }else{
            echo "<script>alert('Data gagal dihapus');document.localition.href='$redirect'</script>";
        }
    }

    function edit($con, $tabel, $where){
        $sql = "SELECT * FROM $tabel WHERE $where";
        $jalan = mysqli_query($con, $sql);
        $tampung = mysqli_fetch_assoc($jalan);
        return $tampung;
    }

    function ubah($con, $tabel, array $field, $where, $redirect){
        $sql = "UPDATE $tabel SET ";
        foreach ($field as $key => $value) {
            $sql.=" $key = '$value',";
        }
        $sql = rtrim($sql,',');
        $sql.=" WHERE  $where";
        $jalan = mysqli_query($con,$sql);

        if($jalan){
            echo "<script>alert('Data berhasil diubah');document.location.href='$redirect'</script>";
        }else{
            echo "<script>alert('Data gagal diubah');document.location.href='$redirect'</script>";
        }
    }

    function update($foto, $tempat){
        $alamat = $foto['tmp_name'];
        $namafile = $foto['name'];
        move_uploaded_file($alamat, "$tempat/$namafile");
        return $namafile;
    }



}

?>