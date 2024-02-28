<?php
session_start();
$userid = $_SESSION['userid'];
include '../config/koneksi.php';

// if ($_SESSION['status'] != 'login') {
//   echo "<script>
//         alert('Anda belum login');
//         location.href='../index.php';
//     </script>";
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web Gallery Foto</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand text-dark" href="index.php"><b>Website Gallery Foto</b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 24 24">
          <path d="M 3 5 A 1.0001 1.0001 0 1 0 3 7 L 21 7 A 1.0001 1.0001 0 1 0 21 5 L 3 5 z M 3 11 A 1.0001 1.0001 0 1 0 3 13 L 21 13 A 1.0001 1.0001 0 1 0 21 11 L 3 11 z M 3 17 A 1.0001 1.0001 0 1 0 3 19 L 21 19 A 1.0001 1.0001 0 1 0 21 17 L 3 17 z">
          </path>
        </svg>
      </button>
      <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
        <div class="navbar-nav me-auto">
          <a href="home.php" class="nav-link text-dark">Home</a>
          <a href="album.php" class="nav-link text-dark">Album</a>
          <a href="foto.php" class="nav-link text-dark">Foto</a>
        </div>
        <a href="../config/proses_logout.php" class="btn btn-outline-danger m-1">Logout</a>
      </div>
    </div>
  </nav>
  <hr>
  <br><br>

  <div class="container mt-3">
    Album :
    <?php
    $album = mysqli_query($conn, "select * from album where userid='$userid'");
    while ($row = mysqli_fetch_array($album)) { ?>
      <a href="home.php?albumid=<?php echo $row['albumid'] ?>" class="btn btn-outline-primary">
        <?php echo $row['namaalbum'] ?>
      </a>
    <?php } ?>

    <div class="row">
      <?php
      if (isset($_GET['albumid'])) {
        $albumid = $_GET['albumid'];
        $query = mysqli_query($conn, "select * from foto where userid='$userid' and albumid='$albumid'");
        while ($data  = mysqli_fetch_array($query)) { ?>
          <div class="col-md-3 mt-3">
            <div class="card">
              <img src="../assets/img/<?php echo $data['lokasifile'] ?>" alt="hii" class="card-img-top" title="<?php echo $data['judulfoto'] ?>" style="height:12rem;">
              <div class="card-footer text-center">

                <?php
                $fotoid = $data['fotoid'];
                $ceksuka = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                if (mysqli_num_rows($ceksuka) == 1) { ?>
                  <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                <?php } else { ?>
                  <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                <?php }
                $like = mysqli_query($conn, "select * from likefoto where fotoid='$fotoid'");
                echo mysqli_num_rows($like) . ' Suka';
                ?>
                <a href=""><i class="fa-regular fa-comment"></i></a>3 Komentar
              </div>
            </div>
          </div>
        <?php }
      } else {


        $query = mysqli_query($conn, "select * from foto where userid='$userid'");
        while ($data = mysqli_fetch_array($query)) {
        ?>
          <div class="col-md-3 mt-3">
            <div class="card">
              <img src="../assets/img/<?php echo $data['lokasifile'] ?>" alt="hii" class="card-img-top" title="<?php echo $data['judulfoto'] ?>" style="height:18rem;">
              <div class="card-footer text-center">

                <?php
                $fotoid = $data['fotoid'];
                $ceksuka = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                if (mysqli_num_rows($ceksuka) == 1) { ?>
                  <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                <?php } else { ?>
                  <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                <?php }
                $like = mysqli_query($conn, "select * from likefoto where fotoid='$fotoid'");
                echo mysqli_num_rows($like) . ' Suka';
                ?>
                <a href=""><i class="fa-regular fa-comment"></i></a>3 Komentar
              </div>
            </div>
          </div>
      <?php }
      } ?>
    </div>
  </div>

  <br><br>
  <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
    <p>&copy; UKK RPL 2024 | Vita Mardiana</p>
  </footer>

  <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>