<?php

include "config/koneksi.php";
include "library/oop.php";

$data = mysqli_query($con, "SELECT * FROM buku WHERE bukuID = '". @$_GET['bukuID']."'");
$r = mysqli_fetch_array($data);

$go = new oop();
$tabel = 'buku';
$field = array(
    'bukuID' => @$_POST['bukuID'],
    'judul' => @$_POST['judul'],
    'penerbitID' => @$_POST['penerbitID'],
    'pengarang' => @$_POST['pengarang'] );
@$redirect = '?menu=buku';
@$where = "bukuID = $_GET[bukuID]";
$idPenerbit = $r['penerbitID'];

if(isset($_POST['update'])){
	$go->ubah($con, $tabel, $field, $where, $redirect);
}

$a = $go->tampilEdit($con, $tabel, $where);
$no = 0;
foreach($a as $r){
}
  ?>
<div class="container">
  <h1 class="bg-primary text-center text-lg" >Halaman Edit Buku</h1>
<form method='post'>

    <tr>
        <td>ID Buku </td>
        <td>:</td>
        <td><input class="form-control me-2" type="text" name="bukuID" value="<?php echo @$r['bukuID'] ?>" required></td>
    </tr>
    <tr>
        <td>Judul Buku </td>
        <td>:</td>
        <td><input class="form-control me-2" type="text" name="judul" value="<?php echo @$r['judul'] ?>" required></td>
    </tr>
    <tr>
    <label class="form-label">Penerbit</label>
        <select name="penerbitID" class="form-control" required>
            <?php 
            $query = mysqli_query($con," SELECT * FROM penerbit order by penerbitID");
            while ($row = mysqli_fetch_array($query)) {
                if ($idPenerbit == $row['penerbitID']){
                    echo '<option value="'.$row['penerbitID'].'" selected>'.$row['penerbit'].'</option>';
                }else
                    echo '<option value="'.$row['penerbitID'].'">'.$row['penerbit'].'</option>';
            } 
           ?>
            
        </select>
    </tr>
    <tr>
        <td>Pengarang </td>
        <td>:</td>
        <td><input class="form-control me-2" type="text" name="pengarang" value="<?php echo @$r['pengarang'] ?>" required></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td><input class="btn btn-success mt-2" type="submit" name="update" value="UPDATE"> <a href="?menu=buku" class="btn btn-warning mt-2">KEMBALI</a></td>
    </tr>

</form>
</div>