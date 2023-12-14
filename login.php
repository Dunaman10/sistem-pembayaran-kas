<?php

session_start();
require 'functions.php';

if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	// ambil nim berdasarkan id
	$result = mysqli_query($db, "SELECT nim FROM user WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	// cek cookie dan nim
	if( $key == hash('sha256', $row['nim']) ) {
		$_SESSION['login'] = true;
	}
}


if( isset($_SESSION["login"]) ) {
	header("Location: index_bendahara.php");
	exit;
}

// cek apakah tombol sudah disubmit atau belum
if( isset($_POST["login"]) ) {
	$nim = $_POST["nim"];
	$password = $_POST["password"];

	$result = mysqli_query($db, "SELECT * FROM user WHERE nim = '$nim'");

	
	// cek nim
	if( mysqli_num_rows($result) === 1 ){
		// cek password
		$row = mysqli_fetch_assoc($result);

		$role = $row['role'];
		if( password_verify($password, $row["password"]) && $role == 'Bendahara' ) {
			// set session
			$_SESSION["login"] = true;

			// Menyimpan ID pengguna dalam sesi
			$_SESSION['login'] = $row['id'];

			// cek remember me
			if( isset($_POST['remember']) ) {
				// buat cookie
				setcookie('id', $row['id'], time()+60);
				setcookie('key', hash('sha256', $row['nim']), time()+60);
			}
				header("Location: index_bendahara.php");
				exit;
		}
		if( password_verify($password, $row["password"]) && $role == 'Non Bendahara' ) {
			// set session
			$_SESSION["login"] = true;

			// Menyimpan ID pengguna dalam sesi
			$_SESSION['login'] = $row['id'];

			// cek remember me
			if( isset($_POST['remember']) ) {
				// buat cookie
				setcookie('id', $_row['id'], time()+60);
				setcookie('key', hash('sha256', $row['nim']), time()+60);
			}
				header("Location: index_mahasiswa.php");
				exit;
		}
		
	}
	
	$error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Sistem Pembayaran Kas</title>

	<!-- Icon Unpam -->
	<link rel="icon" href="dist/img/logo-unpam.png">

	<!-- Tailwind CSS -->
	<script src="https://cdn.tailwindcss.com"></script>

	<!-- AOS -->
	<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

	<!-- Sweet Alert -->
	<link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.js">
	<link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">

</head>

<body>

	<div class="bg-cover bg-center h-[100vh] flex justify-center items-center"
		style="background-image: url(dist/img/bg-unpam.png);">
		<div class="main w-[24rem] h-[35rem] bg-[#DEE4FB] rounded-lg bg-opacity-50 p-6" data-aos="fade-up"
			data-aos-duration="1500">
			<img src="dist/img/logo-unpam.png" alt="Logo Unpam" class="w-48 h-48 mx-auto">

			<form action="" method="post">
				<h1 class="text-center m-6 font-bold text-3xl">LOGIN</h1>

				<div class="text-start flex flex-wrap justify-center gap-5">
					<div class="">
						<label for="nim" class="font-bold">NIM</label>
						<input type="text" id="nim" name="nim" placeholder="masukkan nim anda"
							class="block p-1.5 rounded-xl outline-none" autocomplete="off" required>
					</div>
					<div class="">
						<label for="password" class="font-bold">Password</label>
						<input type="password" id="password" name="password" placeholder="masukkan password anda"
							class="block p-1.5 rounded-xl outline-none" required>
					</div>
				</div>

				<div class="text-center mt-4">
					<input type="checkbox" name="remember" id="remember" class="cursor-pointer">
					<label for="remember" class="font-bold">Remember Me</label>
				</div>

				<div class="flex justify-center mt-4">
					<button type="submit" name="login"
						class="transition ease-in-out delay-150 bg-sky-500 hover:-translate-y-1 hover:scale-110 hover:bg-sky-600 duration-300 p-2 rounded-xl text-white me-2 out">Masuk</button>
					<a href="daftar.php"
						class="transition ease-in-out delay-150 bg-sky-500 hover:-translate-y-1 hover:scale-110 hover:bg-sky-600 duration-300 p-2 rounded-xl text-white">Daftar</a>
				</div>



				<?php if( isset($error) ) :  ?>
				<script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
				<script>
					Swal.fire({
						text: 'Username Atau Password Anda Salah',
						icon: 'warning',
						confirmButtonText: 'Ulangi',
					});
				</script>
				<?php endif; ?>


			</form>

		</div>
	</div>

	<!-- AOS -->
	<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
	<script>
		AOS.init();
	</script>

</body>

</html>