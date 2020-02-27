<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

if( isset($_POST["add"])){
  //check data success send
  if (add($_POST) > 0) {
    echo "<script>
            alert('data berhasil ditambahkan!');
            document.location.href = 'home.php';
          </script>";
  }else {
    echo "<script>
            alert('data gagal ditambahkan!');
            document.location.href = 'add.php';
          </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Students</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="add.php">
                Students
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item dropdown">
                    <a class="dropdown-item" href="logout.php">Logout</a>
                  </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-md-8">
                  <div class="card">
                      <div class="card-header text-primary">Add Students</div>

                      <div class="card-body">
                          <form method="POST" action="" enctype="multipart/form-data">
                              <div class="form-group row">
                                  <label for="nis" class="col-md-4 col-form-label text-md-right">NIS</label>

                                  <div class="col-md-6">
                                      <input id="nis" type="text" class="form-control" name="nis" required autofocus>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="nama" class="col-md-4 col-form-label text-md-right">Nama</label>

                                  <div class="col-md-6">
                                      <input id="nama" type="text" class="form-control" name="nama" required>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                  <div class="col-md-6">
                                      <input id="email" type="email" class="form-control" name="email" autocomplete="email" required>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="jurusan" class="col-md-4 col-form-label text-md-right">Jurusan</label>

                                  <div class="col-md-6">
                                      <input id="jurusan" type="text" class="form-control" name="jurusan" required>
                                  </div>
                              </div>

                              <div class="form-group row mb-0">
                                  <div class="col-md-8 offset-md-4">
                                      <button type="submit" class="btn btn-primary" name="add">
                                          Add
                                      </button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </main>

</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>

</html>
