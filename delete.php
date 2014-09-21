<?php
include('koneksi.php');
$kode_orang=$_POST['kode'];
$query = mysql_query('delete from tbl_orang where id_orang in ('.$kode_orang.')'); 
echo 1;
?>