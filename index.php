<!--
    NIM :A11.2022.14741
    don't feel "bad" about your code!
-->
<?php
require_once 'config/koneksi_database.php';

function tampilinallData()
{

    global $koneksi;
    $sql = "SELECT * FROM datatodolist ORDER BY Deadline DESC";
    return $koneksi->query($sql);
} 
function tampilinsatuData($no)
{

  global $koneksi;
  $sql = "SELECT * FROM datatodolist WHERE no = ?";
  $tampilinsatu = $koneksi->prepare($sql);
  $tampilinsatu->execute([$no]);
  return $tampilinsatu->fetch();
}
function a112214741()
{
  $nimmhs = "A11.2022.14741";
  $namamhs = "M Reza";

  echo "SIMPLE TO DO LIST"," | ", $nimmhs," | ", $namamhs;
}
function titleweb()
{
  $title = "Simple To Do List";
  $tugas = "TA DNCC";

  echo $title," | ", $tugas;
}
function tambahData($tampungdata)
{

  global $koneksi;
  $sql  = "INSERT INTO datatodolist (Nama_Tugas,Deadline,Keterangan) VALUES (?,?,'On going')";
  $tambahdata = $koneksi->prepare($sql);
  $tambahdata->execute([$tampungdata['Nama_Tugas'], $tampungdata['Deadline']]);

}
if (isset($_GET['delete'])) {

  global $koneksi;
	$id = $_GET['id'];
	$sql = "DELETE FROM datatodolist WHERE no= ?";
	$row = $koneksi->prepare($sql);
	$row->execute(array($id));
	
  header("location: index.php");
}
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
    <title><?php titleweb() ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
    .my-custom-scrollbar {
position: relative;
height: 450px;
overflow: auto;
}
</style>
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

  <div class="container-sm  card  mt-4">
  <div class="card-header">
    <?php a112214741() ?>
  </div>
  <div class="card-body">
    <form method="POST" action="">
  <div class="mb-3">
    <label for="tugassaya" class="form-label">Tugas :</label>
    <input type="text" class="form-control" name="Nama_Tugas" placeholder="Input tugas yang ingin anda catat..." id="tugassaya" aria-describedby="emailHelp">
  </div>        
  <div class="mb-3">
    <label for="deadlinetugas" class="form-label">Deadline :</label>
    <input type="date" class="form-control" name="Deadline" id="deadlinetugas">
  </div>
  <button type="submit" name="simpantugas" class="btn btn-primary">Simpan tugas</button>
</form>
<?php
  if (isset($_POST['simpantugas'])) {

if ($_POST['Nama_Tugas'] == "") {
    echo "<center><div class='alert alert-danger col-md-6 mt-3'>";
    echo "<strong>Error!</strong> Field input Tugas anda kosong.";
    echo "</div></center>";
}

if ($_POST['Deadline'] == "") {
    echo "<center><div class='alert alert-warning col-md-6 mt-3'>";
    echo "<strong>Error!</strong> Field input Deadline anda kosong.";
    echo "</div></center>";
}
if ($_POST['Nama_Tugas'] && $_POST['Deadline']) 
{
  $tampungdata = 
  [
      'Nama_Tugas' => htmlspecialchars($_POST['Nama_Tugas']),
      'Deadline' => htmlspecialchars($_POST['Deadline'])
  ];

  tambahData($tampungdata);
  header("location: index.php");
}
}
?>
  </div>
</div>
<div class="container-sm card mt-4">
  <div class="card-header">
    History
  </div>
  <div class="card-body my-custom-scrollbar">
<table class="table table-striped table-hover">
<thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama Tugas</th>
      <th scope="col">Deadline</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php
            $numb = 1;
            foreach (tampilinallData() as $roww) :
            $dl = strtotime($roww['Deadline']);;
            $skrg = time();

            $rezaa  = $dl - $skrg;
            ?>
    <tr>
      <th scope="row"><?php echo $numb++ ?></th>
      <td><?php echo $roww['Nama_Tugas'] ?></td>
      <td><?php echo date('d F Y', strtotime($roww['Deadline'])) ?></td>
      <td><?php
       echo  ''. floor($rezaa / (60 * 60 * 24)) . ''; 
       if($rezaa<1)
       {
        echo " Hari yang lalu";
       }else{
        echo " Hari lagi";
       }
       /*
       if ($rezaa>1) {
        echo " <font color='red'>[ Nice ]</font> ";
      }else{
        echo " <font color='red'>[ Terlambat ]</font> ";
      }
      */
       ?></td>
      <td>
        <a href="edit.php?edit&id=<?php echo $roww['no'];?>"><button class="btn btn-info">Edit</button></a>
        <a onclick="return confirm('Apakah yakin data akan di hapus?')" href="index.php?delete&id=<?php echo $roww['no'];?>" 
							class="btn btn-danger">Delete</a></td>
    </tr>
  </tbody>
  <?php endforeach ?>
</table>
    </div>
    </div>
    </div>
<footer class="footer bg-dark p-3 mt-4">
		<div class="container">
			<div class="row text-light">
				<div class="col-6 text-lg-start text-sm-start ">
           since ©2022.
				</div>
				<div id="footer" class="col-6 text-lg-end text-sm-end">
        made with ❤ by riize.
				</div>
			</div>
		</div>
	</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>