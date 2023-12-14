<?php

require 'functions.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Daftar Sistem Pembayaran Kas</title>

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
		<div class="main w-[24rem] h-[40rem] bg-[#DEE4FB] rounded-lg bg-opacity-50 p-6" data-aos="fade-up"
			data-aos-duration="1500">
			<img src="dist/img/logo-unpam.png" alt="Logo Unpam" class="w-36 h-36 mx-auto">

			<form action="" method="post">
				<h1 class="text-center m-2 font-bold text-3xl	">Daftar</h1>

				<div class="text-start flex flex-wrap justify-center gap-5">
					<div class="">
						<label for="nama" class="font-bold">Nama</label>
						<input type="text" id="nama" name="nama" placeholder="masukkan nama anda"
							class="block p-1.5 rounded-xl outline-none" autocomplete="off" required>
					</div>
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
					<div class="">
						<label for="password2" class="font-bold">Konfirmasi Password</label>
						<input type="password" id="password2" name="password2" placeholder="masukkan password anda"
							class="block p-1.5 rounded-xl outline-none" required>
					</div>
					<div class="">
						<label for="role" class="font-bold">Pilih Role Anda</label>
						<select name="role" id="role" class="p-1.5 rounded-lg outline-none cursor-pointer" required>
							<option selected>Pilih Role</option>
							<option value="Bendahara">Bendahara</option>
							<option value="Non Bendahara">Mahasiswa</option>
						</select>
					</div>
				</div>

				<div class="flex justify-center mt-4">
					<a href="login.php"
						class="transition ease-in-out delay-150 bg-sky-500 hover:-translate-y-1 hover:scale-110 hover:bg-sky-600 duration-300 p-2 rounded-xl text-white mx-2">Kembali</a>
					<button type="submit" name="daftar"
						class="transition ease-in-out delay-150 bg-sky-500 hover:-translate-y-1 hover:scale-110 hover:bg-sky-600 duration-300 p-2 rounded-xl text-white mx-2">Daftar</button>
				</div>

			</form>

		</div>
	</div>


	<script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
	<?php
	
	if( isset($_POST["daftar"]) ) {
		if( registrasi($_POST) > 0 ) {
			echo "
						<script>
							Swal.fire({
								title: 'Yeay!',
								text: 'Pengguna Baru Berhasil di Tambahkan',
								icon: 'success',
								textButtonConfirm: 'Oke',
							});
						</script>
					";
		} else {
			echo mysqli_error($db);
		}
	}
	
	?>

	<!-- AOS -->
	<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
	<script>
		AOS.init();
	</script>

</body>

</html>