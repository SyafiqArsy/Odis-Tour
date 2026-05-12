<?php
$koneksi = mysqli_connect("localhost","root","","website_umroh");
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
?>