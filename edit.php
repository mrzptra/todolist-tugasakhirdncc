<!--
    NIM :A11.2022.14741
    don't feel "bad" about your code!
-->
<?php
require_once('config/koneksi_database.php');
	
	// berikut script untuk proses edit ke database 
	if(!empty($_POST['Nama_Tugas'])){
		// menangkap data post	
		$Nama_Tugas = htmlspecialchars($_POST['Nama_Tugas']);
    $Deadline = htmlspecialchars($_POST['Deadline']);
    $Keterangan = htmlspecialchars($_POST['Keterangan']);
    $no = htmlspecialchars($_GET['id']);

		$data[] = $Nama_Tugas;
		$data[] = $Deadline;
		$data[] = $Keterangan;
		$data[] = $no;

  global $koneksi;
		// simpan data barang
		$sql = 'UPDATE datatodolist SET Nama_Tugas=?,Deadline=?,Keterangan=? WHERE no=?';
		$row = $koneksi->prepare($sql);
		$row->execute($data);
		
		// redirect
		echo '<script>alert("Berhasil Edit Data bosku");window.location="index.php"</script>';
	}
	// untuk menampilkan data barang berdasarkan id barang

	$id = $_GET['id'];
	$sql = "SELECT *FROM datatodolist WHERE no= ?";
	$row = $koneksi->prepare($sql);
	$row->execute(array($id));
	$hasil = $row->fetch();
?>
<!doctype html>
<html lang="en">
  <head>
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="To Do List - List everything that you have to do">
    <meta name="description" content="With To Do List you can manage list everything that you have to do.">
    <meta property="og:type" content="website">
    <meta name="author" content="A11.2022.14741">
    <meta property="og:url" content="http://todolist.rzptra.my.id/">
    <meta property="og:title" content="To Do List - List everything that you have to do">
    <meta property="og:description" content="With To Do List you can manage list everything that you have to do.">
    <meta property="og:image" content="img/image.jpg">
    <title>Edit Data - TA DNCC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
  <nav id="home" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">RIIZE</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>  
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">About us</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link active" aria-current="page" href="#">DNCC</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
  <div class="container-sm  card mt-4">
  <div class="card-header">
    Edit Data
  </div>
  <div class="card-body">
    <form method="POST" action="">
    <div class="mb-3">
    <label for="primarykey" class="form-label">Primary key :</label>
    <input type="text" class="form-control" value="<?php echo $hasil['no'];?>" name="no" id="primarykey" aria-describedby="emailHelp" disabled>
  </div> 
  <div class="mb-3">
    <label for="tugassaya" class="form-label">Tugas :</label>
    <input type="text" class="form-control" value="<?php echo $hasil['Nama_Tugas'];?>" name="Nama_Tugas" id="tugassaya" aria-describedby="emailHelp">
  </div>        
  <div class="mb-3">
    <label for="deadlinetugas" class="form-label">Deadline :</label>
    <input type="date" value="<?php echo $hasil['Deadline'];?>" class="form-control" name="Deadline" id="deadlinetugas">
  </div>
  <div class="mb-3">
    <label for="Keterangan" class="form-label">Keterangan :</label>
    <input type="text" class="form-control" value="<?php echo $hasil['Keterangan'];?>" id="keterangan" name="Keterangan" aria-describedby="emailHelp">
  </div> 
  <button type="submit" class="btn btn-primary">Edit tugas</button>
</form>
  </div>
</div> 
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>