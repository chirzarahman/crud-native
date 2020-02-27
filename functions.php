<?php

//Connect to Database
$conn = mysqli_connect("localhost", "root", "", "db_native");

function query($query){
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
  $nis = htmlspecialchars($data["nis"]);
  $nama = htmlspecialchars($data["nama"]);
  $email = strtolower(stripslashes($data["email"]));
  $jurusan = htmlspecialchars($data["jurusan"]);

  $query = "INSERT INTO students (nis, nama, email, jurusan) VALUES ('$nis', '$nama', '$email', '$jurusan')";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function delete($id){
  global $conn;
  mysqli_query($conn, "DELETE FROM students WHERE id = $id");
  return mysqli_affected_rows($conn);
}

function edit($data){
  global $conn;

  $id = $data["id"];
  $nis = htmlspecialchars($data["nis"]);
  $nama = htmlspecialchars($data["nama"]);
  $email = strtolower(stripslashes($data["email"]));
  $jurusan = htmlspecialchars($data["jurusan"]);

  $query = "UPDATE students SET
              nis = '$nis',
              nama = '$nama',
              email = '$email',
              jurusan = '$jurusan'
            WHERE id = $id
            ";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function register($data){
  global $conn;

  $username = strtolower(stripslashes($data["username"]));
  $email = strtolower(stripslashes($data["email"]));
  $fullname = strtolower(stripslashes($data["fullname"]));
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
  mysqli_query($conn, "INSERT INTO users (username, email, fullname, password) VALUES ('$username', '$email', '$fullname', '$password')");
  return mysqli_affected_rows($conn);
}

?>
