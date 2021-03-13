<?php

include "config/koneksi.php";
include "library/oop.php";

$go = new oop();
$tabel = 'view_buku';

$field = array(
    'bukuID' => @$_POST['bukuID'],
    'judul' => @$_POST['judul'],
    'penerbit' => @$_POST['penerbit'],
    'pengarang' => @$_POST['pengarang'] );
@$penerbitID = " penerbitID = $_GET[penerbitID]";
@$redirect = '?menu=buku';
@$where = "bukuID = $_GET[bukuID]";

?>
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>NO</th>
            <th>ID Buku</th>
            <th>Judul Buku</th>
            <th>Penerbit</th>
            <th>Pengarang</th>

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
            <td><?= $r['penerbit']?> </td>
            <td><?php echo $r['pengarang'] ?></td>

        </tr>
        <?php }  } ?>

    </tbody>
</table>