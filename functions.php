<?php

//Connect to Database
$conn = mysqli_connect("localhost", "root", "root", "db_crud_native");

function query ($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function add ($data){
  global $conn;
  $nama = htmlspecialchars($data["nama"]);
  $kaki = htmlspecialchars($data["kaki"]);
  $gol_habitat = htmlspecialchars($data["gol_habitat"]);
  $gol_makanan = htmlspecialchars($data["gol_makanan"]);

  $query = "INSERT INTO animals (nama,kaki, gol_habitat, gol_makanan) VALUES ('$nama', '$kaki', '$gol_habitat', '$gol_makanan')";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function delete($id){
  global $conn;
  mysqli_query($conn, "DELETE FROM animals WHERE id = $id");
  return mysqli_affected_rows($conn);
}

function edit($data){
  global $conn;

  $id = $data["id"];
  $nama = htmlspecialchars($data["nama"]);
  $kaki = htmlspecialchars($data["kaki"]);
  $gol_habitat = htmlspecialchars($data["gol_habitat"]);
  $gol_makanan = htmlspecialchars($data["gol_makanan"]);

  $query = "UPDATE animals SET
              nama = '$nama',
              kaki = '$kaki',
              gol_habitat = '$gol_habitat',
              gol_makanan = '$gol_makanan'
            WHERE id = $id
            ";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function register($data){
  global $conn;

  $username = strtolower(stripslashes($data["username"]));
  $email = strtolower(stripslashes($data["email"]));
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $password2 = mysqli_real_escape_string($conn, $data["password2"]);

  //cek username sudah ada atau belum
  $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

  if (mysqli_fetch_assoc($result)) {
    echo "<script>
            alert('Username sudah terdaftar!');
          </script>";
    return false;
  }

  if ($password !== $password2) {
    echo "<script>
            alert('Konfirmasi password tidak sesuai!');
          </script>";
    return false;
  }

  //enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  //tambah user baru
  mysqli_query($conn, "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')");
  return mysqli_affected_rows($conn);
}

?>
