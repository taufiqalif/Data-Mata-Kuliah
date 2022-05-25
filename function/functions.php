<?php 
// koneksi database
$conn = mysqli_connect("localhost","root","","datakampus");


function query($query) {
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while( $row = mysqli_fetch_assoc($result) ) {
    $rows[] = $row;
  }
  return $rows;
}

function tambah($data) {
  global $conn;

  $nama = htmlspecialchars($data["nama"]);
  $mata_kuliah = htmlspecialchars($data["mata_kuliah"]);
  $semester = htmlspecialchars($data["semester"]);

  // upload file
  $file = upload();
  if( !$file ) {
    return false;
  }


  $query = "INSERT INTO matkul VALUES ('','$nama','$mata_kuliah','$semester','$file')";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}


function upload(){
  $namaFile = $_FILES['file']['name'];
  $ukuranFile = $_FILES['file']['size'];
  $error = $_FILES['file']['error'];
  $tmpName = $_FILES['file']['tmp_name'];

  // cek apakah tidak ada gambar yang diupload
  if( $error === 4 ) {
    echo "<script>
            alert('pilih file terlebih dahulu!');
          </script>";
    return false;
  }

  // cek apakah yang diupload adalah file
  $ekstensiFileValid = ['pdf', 'ppt', 'pptx', 'doc', 'docx' , 'xls', 'xlsx'];
  $ekstensiFile = explode('.', $namaFile);
  $ekstensiFile = strtolower(end($ekstensiFile));
  if( !in_array($ekstensiFile, $ekstensiFileValid) ) {
    echo "<script>
            alert('yang anda upload bukan file!');
          </script>";
    return false;
  }

  // cek jika ukuran terlalu besar
  if( $ukuranFile > 15000000 ) {
    echo "<script>
            alert('ukuran gambar terlalu besar!');
          </script>";
    return false;
  }

  // lolos pengecekan
  // generate nama gambar baru
  // $namaFileBaru = uniqid();
  // $namaFileBaru .= '.';
  // $namaFileBaru .= $ekstensiFile;

  move_uploaded_file($tmpName, '../file/' . $namaFile);

  return $namaFile;
}


function hapus($id) {
  global $conn;
  mysqli_query($conn, "DELETE FROM matkul WHERE id = $id");

  return mysqli_affected_rows($conn);
}


function ubah($data) {
  global $conn;

  $id = $data["id"];
  $nama = htmlspecialchars($data["nama"]);
  $mata_kuliah = htmlspecialchars($data["mata_kuliah"]);
  $semester = htmlspecialchars($data["semester"]);
  $fileLama = htmlspecialchars($data["fileLama"]);

  // cek apakah user pilih file baru atau tidak
  if( $_FILES['file']['error'] === 4 ) {
    $file = $fileLama;
  } else {
    $file = upload();
  }
  
  $query = "UPDATE matkul SET
            nama = '$nama',
            mata_kuliah = '$mata_kuliah',
            semester = '$semester',
            file = '$file'
            WHERE id = $id
            ";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}





function cari($keyword){
  $query = "SELECT * FROM matkul WHERE
            nama LIKE '%$keyword%' OR
            mata_kuliah LIKE '%$keyword%' OR
            semester LIKE '%$keyword%'
            ";
  return query($query);
}



function registrasi($data){
  global $conn;

  $username = strtolower(stripslashes($data["username"]));
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $password2 = mysqli_real_escape_string($conn, $data["password2"]);

  // cek username sudah ada atau belum
  $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
  if( mysqli_fetch_assoc($result) ) {
    echo "<script>
            alert('username sudah terdaftar!');
          </script>";
    return false;
  }

  // cek konfirmasi password 
  if( $password !== $password2 ) {
    echo "<script>
            alert('konfirmasi password tidak sesuai!');
          </script>";
    return false;
  }

  // enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // tambahkan user baru ke database
  mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password')");

  return mysqli_affected_rows($conn);
}


// function login($data){
//   global $conn;

//   $username = $data["username"];
//   $password = $data["password"];

//   // cek username
//   $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
//   if( mysqli_num_rows ($result) === 1 ) {

//     // cek password
//     $row = mysqli_fetch_assoc($result);
//     if( !password_verify($password, $row["password"]) ) {
//       echo "<script>
//               alert('password salah!');
//             </script>";
//       return false;
//       exit;
//     }
//   }


//   // set session
//   $_SESSION["login"] = true;

//   return mysqli_affected_rows($conn);
// }


function lihat($id){
  global $conn;

  $query = "SELECT * FROM matkul WHERE id = $id";
  return query($query);
}

?>