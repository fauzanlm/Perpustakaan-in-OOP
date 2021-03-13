<?php

include "config/koneksi.php";
include "library/oop.php";


$go = new oop();
$tabel = 'penerbit';
$field = array(
    'penerbitID' => @$_POST['penerbitID'],
    'penerbit' => @$_POST['penerbit'] );
    
@$redirect = '?menu=penerbit';
@$where = "penerbitID = $_GET[penerbitID]";

if(isset($_POST['simpan'])){
    $go->simpan($con, $tabel, $field, $redirect);
}

if(isset($_GET['hapus'])){
    $go->hapus($con, $tabel, $where, $redirect);
}

if(isset($_GET['edit'])){
    $edit = $go->edit($con, $tabel, $where);
}

if(isset($_POST['ubah'])){
    $go->ubah($con, $tabel, $field, $where, $redirect);
}

?>

<form method='post'>
<div class="container">

    <tr>
        <td>ID Penerbit </td>
        <td>:</td>
        <td><input class="form-control me-2" type="text" name="penerbitID" value="<?php echo @$edit['penerbitID'] ?>" required></td>
    </tr>
    <tr>
        <td>Penerbit </td>
        <td>:</td>
        <td><input class="form-control me-2" type="text" name="penerbit" value="<?php echo @$edit['penerbit'] ?>" required></td>
    </tr>
        <tr>
        <td></td>
        <td></td>
        <td>
            <?php if(@$_GET['penerbitID']=="") { ?>
            <input class="btn btn-primary mt-2" type="submit" name="simpan" value="SIMPAN">
            <?php }else{ ?>
            <input class="btn btn-success mt-2" type="submit" name="ubah" value="UPDATE">
            <?php } ?>
        </td>
    </tr>

</form>
</div>
<br>
 
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>NO</th>
            <th>ID Penerbit</th>
            <th>Penerbit</th>
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
            <td><?php echo $r['penerbitID'] ?></td>
            <td><?php echo $r['penerbit'] ?></td>
            <td><a class="btn btn-warning" href="?menu=penerbit&edit&penerbitID=<?= $r['penerbitID'] ?>">Edit</a></td>
            <td><a class="btn btn-danger" href="?menu=penerbit&hapus&penerbitID=<?= $r['penerbitID'] ?>" onclick="return confirm('Hapus data <?php echo $r['penerbit'] ?> ?')">Hapus</a></td>
        </tr>
        <?php }  } ?>

    </tbody>
</table>