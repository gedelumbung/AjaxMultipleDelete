<?php
include('koneksi.php');
$qu = mysql_query("select * from tbl_orang");
if(mysql_num_rows($qu)<1)
{
	mysql_query("INSERT INTO tbl_orang (`id_orang`, `nama`) VALUES (NULL, 'Gede Lumbung'), (NULL, 'Budi Raharjo'), (NULL, 'Ivan Gunawan'), (NULL, 'Thomas Lorenzo'), (NULL, 'Roy Suryo'), (NULL, 'Surya Husada'), (NULL, 'Pratama Antara'), (NULL, 'Widya Sari'), (NULL, 'Asti Sri Astuti'), (NULL, 'Omla Ramlan'), (NULL, 'Budi Raharjo'), (NULL, 'Engkong Satu'), (NULL, 'Engkong Dua'), (NULL, 'Engkong Tiga'), (NULL, 'Engkong Muda')");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Menghapus Multiple Data Via AJAX Dengan jQuery</title>
<style>
body{
font-family:Arial;
font-size:12px;
}
a:hover{
padding:3px;
background:#FF9900;
text-decoration:none;
color:#000000;
}
a{
padding:3px;
text-decoration:none;
color:#000000;
}
</style>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(function(){
	$("a.hapus").click(function(){
		id_array=new Array()
		i=0;
		$("input.chk:checked").each(function(){
			id_array[i]=$(this).val();
			i++;
		})
				
		$.ajax({
			url:'delete.php',
			data:"kode="+id_array,
			type:"POST",
			success:function(respon)
			{
				if(respon==1)
				{
					$("input.chk:checked").each(function(){
						$(this).parent().parent().remove('.chk').animate({ opacity: "hide" }, "slow");
					})
				}
			}
		})

		return false;
	})
})
</script>
</head>

<body>
<table cellpadding="5" cellspacing="0" border="1">
<tr align="center"><td><a href="#" class="hapus">Hapus</a></td><td>Kode Dosen</td><td>Nama Dosen</td></tr>
<?php
$q = mysql_query("select * from tbl_orang");
$no=1;
while($b = mysql_fetch_array($q))
{
echo '
<tr align="center">
<td><input type="checkbox" value="'.$b["id_orang"].'" name="chk[]" class="chk" id="chk-'.$no.'" /></td><td>'.$b["id_orang"].'</td><td>'.$b["nama"].'</td>
</tr>
';
$no++;
}
?>
<tr><td colspan="3"><input type=radio name=pilih onClick='for (i=1;i<<?php echo $no; ?>;i++){document.getElementById("chk-"+i).checked=true;}'>
    Centang Semua
    <input type=radio name=pilih onClick='for (i=1;i<<?php echo $no; ?>;i++){document.getElementById("chk-"+i).checked=false;}'>
    Hapus Semua Centang</td></tr>
</table>
</body>
</html>
