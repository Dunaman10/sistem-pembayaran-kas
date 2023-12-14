<?php

// Koneksi db
$db = mysqli_connect("localhost", "root", "", "spk");

function query($query) {
	global $db;
	$result = mysqli_query($db, $query);
	$row = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}

	return $rows;
}

// fungsi untuk daftar
function registrasi($data) {
	global $db;

	$nama = stripcslashes($data["nama"]);
	$nim = strtolower(stripslashes($data["nim"]));
	$password = mysqli_real_escape_string($db, $data["password"]);
	$password2 = mysqli_real_escape_string($db, $data["password2"]);
	$role = stripslashes($data["role"]);
	

	// cek nim sudah ada atau belum
	$result = mysqli_query($db, "SELECT nim FROM user WHERE nim = '$nim'");
	if( mysqli_fetch_assoc($result) ) {
		echo "
		<script src='node_modules/sweetalert2/dist/sweetalert2.min.js'></script>
					<script>
					Swal.fire({
						text: 'Nim Sudah Terdaftar!',
						icon: 'warning',
						textButtonConfirm: 'Oke',
					});
					</script>
				";
		return false;
	}

	// cek konfirmasi password
	if( $password !== $password2 ) {
		echo "
					<script>
						alert('konfirmasi password tidak sesuai!');
					</script>
				";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// menambahkan user terbaru ke database
	mysqli_query($db, "INSERT INTO user VALUES('', '$nama', '$nim', '$password', '$role')");

	return mysqli_affected_rows($db);

}

// fungsi untuk menambahkan mahasiswa ke dalam tabel
function add($data) {
	global $db;
	// ambil data dari tiap elemen dalam form
	$nama = htmlspecialchars($data["nama"]);
	$nim = htmlspecialchars($data["nim"]);

	// query inset data 
	$query = "INSERT INTO mahasiswa
						VALUES
						('', '$nama', '$nim', '', '', '')
						";
	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}

// fungsi untuk edit data dalam tabel
function edit($data) {
	global $db;
	// ambil data dari tiap elemen
	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$nim = htmlspecialchars($data["nim"]);
	$tanggal1 = htmlspecialchars($data["tanggal1"]);
	$tanggal2 = htmlspecialchars($data["tanggal2"]);
	$tanggal3 = htmlspecialchars($data["tanggal3"]);

	// query insert data
	$query = "UPDATE mahasiswa SET
							nama = '$nama',
							nim = '$nim',
							tanggal1 = '$tanggal1',
							tanggal2 = '$tanggal2',
							tanggal3 = '$tanggal3'
						WHERE id = $id
						";
	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}

// fungsi untuk menghapus data dalam tabel
function delete($id) {
	global $db;
	mysqli_query($db, "DELETE FROM mahasiswa WHERE id = $id");
	return mysqli_affected_rows($db);
}

?>