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
@$idPenerbit = $r['penerbitID'];

if(isset($_POST['simpan'])){
    $go->simpan($con, $tabel, $field, $redirect);
}

if(isset($_GET['hapus'])){
    $go->hapus($con, $tabel, $where, $redirect);
}

?>

<div class="container">
<form method='post'>

    <tr>
        <td>ID Buku </td>
        <td>:</td>
        <td><input class="form-control me-2" type="text" name="bukuID" value="<?php echo @$edit['bukuID'] ?>" required></td>
    </tr>
    <tr>
        <td>Judul Buku </td>
        <td>:</td>
        <td><input class="form-control me-2" type="text" name="judul" value="<?php echo @$edit['judul'] ?>" required></td>
    </tr>
    <tr>
    <label class="form-label">Penerbit</label>
        <select name="penerbitID" class="form-control" required>
            <option class="select disable">Select</option>
            <?php 
                $sql = mysqli_query($con, "SELECT * FROM penerbit");
                while($r=mysqli_fetch_assoc($sql)){
            ?>
            <option value="<?php echo $r['penerbitID'] ?>"><?php echo $r['penerbit'] ?></option>
            <?php } ?>
        </select>
    </tr>
    <tr>
        <td>Pengarang </td>
        <td>:</td>
        <td><input class="form-control me-2" type="text" name="pengarang" value="<?php echo @$edit['pengarang'] ?>" required></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td><input class="btn btn-primary mt-2" type="submit" name="simpan" value="SIMPAN"></td>
    </tr>

</form>
</div>
<br>
 
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>NO</th>
            <th>ID Buku</th>
            <th>Judul Buku</th>
            <th>Penerbit</th>
            <th>Pengarang</th>
            <th>Aksi</th>
            <th></th>

        </tr>
    </thead>
    <tbody>

        <?php
            $a = $go->tampil($con, $tabel);
            $no = 0;

            if($a == ""){
                echo "<tr><td colspan='7' align='center'>No Record</td></tr>";
            } else {

            foreach($a as $r){
            $no++;
        ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $r['bukuID'] ?></td>
            <td><?php echo $r['judul'] ?></td>
            <td><?php echo $r['penerbitID'] ?></td>
            <td><?php echo $r['pengarang'] ?></td>
            <td><a class="btn btn-warning" href="?menu=edit&bukuID=<?= $r['bukuID'] ?>">Edit</a></td>
            <td><a class="btn btn-danger" href="?menu=buku&hapus&bukuID=<?= $r['bukuID'] ?>" onclick="return confirm('Hapus data <?php echo $r['judul'] ?> ?')">Hapus</a></td>
        </tr>
        <?php }  } ?>

    </tbody>
</table>