
<?php
	$user  = 'root';
	$pass = '';
	try {
		// buat koneksi dengan database
		$koneksi = new PDO('mysql:host=localhost;dbname=todolist;',$user,$pass);
		// set error mode
		$koneksi->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}catch (PDOException $e) {
		// tampilkan pesan kesalahan jika koneksi gagal
		print "Koneksi atau query bermasalah : " . $e->getMessage() . "<br/>";
		die();
	}
	

/*
koneksi menggunakan mysql version
<?php
$servername = "localhost";
$database = "todolist";
$username = "root";
$password = "";
 
$conn = mysqli_connect($servername, $username, $password, $database);
// mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
echo "Koneksi berhasil";
mysqli_close($conn);
?> 
*/