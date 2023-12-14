<?php

session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

// ambil data di URL
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Data Mahasiswa</title>

	<!-- Tailwind CSS -->
	<script src="https://cdn.tailwindcss.com"></script>

	<!-- MY CSS -->
	<style>
		.navbar-fixed {
			position: fixed;
			z-index: 9999;
			background-color: white;
			box-shadow: inset 0 -1px rgba(0, 0, 0, 0.2);
		}

		.hamburger-line {
			width: 30px;
			height: 2px;
			margin-top: 0.5rem;
			margin-bottom: 0.5rem;
			display: block;
			background-color: black;
		}

		.hamburger-active>span:nth-child(1) {
			transform: rotate(45deg);
		}

		.hamburger-active>span:nth-child(2) {
			transform: scale(0);
		}

		.hamburger-active>span:nth-child(3) {
			transform: rotate(-45deg);
		}
	</style>

	<!-- My Icons -->
	<script src="https://unpkg.com/feather-icons"></script>

	<!-- AOS -->
	<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

	<!-- My Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400;600;700&display=swap" rel="stylesheet">

	<!-- Sweet Alert -->
	<link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.js">
	<link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">


</head>

<body style="font-family: 'Oswald', sans-serif;" class="bg-gradient-to-r from-slate-200 to-slate-100">



	<div class="min-h-screen">
		<h1 class="pt-20 text-slate-800 font-bold text-2xl lg:text-4xl text-center" data-aos="fade-up" data-aos-duration="1500"><span
				class="bg-gradient-to-l from-sky-600 to-sky-400 bg-clip-text text-transparent">Edit Data Kas Mahasiswa</span></h1>

		<form action="" method="post" class="mx-auto mt-10 w-72" data-aos="fade-up" data-aos-duration="1500">
			<input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
			<div class="">
				<label for="nama" class="block">NAMA : </label>
				<input class="p-1 w-full text-center rounded-lg" type="text" name="nama" id="nama" autocomplete="off"
					value="<?= $mhs["nama"]; ?>">
			</div>
			<div class="mt-4">
				<label for="nim" class="block">NIM : </label>
				<input class="p-1 w-full text-center rounded-lg" type="text" name="nim" id="nim" autocomplete="off" value="<?= $mhs["nim"]; ?>">
			</div>
			<div class="mt-4">
				<label for="tanggal1" class="block">10/10/2023 : </label>
				<input class="p-1 w-full text-center rounded-lg" type="text" name="tanggal1" id="tanggal1" autocomplete="off"
					value="<?= $mhs["tanggal1"]; ?>">
			</div>
			<div class="mt-4">
				<label for="tanggal2" class="block">11/10/2023 : </label>
				<input class="p-1 w-full text-center rounded-lg" type="text" name="tanggal2" id="tanggal2" autocomplete="off"
					value="<?= $mhs["tanggal2"]; ?>">
			</div>
			<div class="mt-4">
				<label for="tanggal3" class="block">12/10/2023 : </label>
				<input class="p-1 w-full text-center rounded-lg" type="text" name="tanggal3" id="tanggal3" autocomplete="off"
					value="<?= $mhs["tanggal3"]; ?>">
			</div>
			<div class="my-4 flex justify-between">
				<a href="index_bendahara.php"
				class="transition ease-in-out delay-150 bg-sky-500 hover:-translate-y-1 hover:scale-110 hover:bg-sky-600 duration-300 p-3 font-semibold flex rounded-md shadow-lg text-slate-200 w-20 justify-center">Kembali</a>
				<button type="submit" name="submit"
					class="transition ease-in-out delay-150 bg-sky-500 hover:-translate-y-1 hover:scale-110 hover:bg-sky-600 duration-300 p-3 font-semibold flex rounded-md shadow-lg text-slate-200 w-20 justify-center">Edit</button>
			</div>
		</form>
	</div>

	<!-- Footer Start -->
	<footer class="bg-gradient-to-l from-sky-600 to-sky-400 text-center text-slate-200 absolute w-full h-24">
		<div class="container py-5">
			<p>Copyright.2023 | Syarif Hidayatullah</p>
			<div class="flex justify-center pt-2">
				<a href="#" class="mx-4 hover:text-sky-200"><i data-feather="linkedin"></i></a>
				<a href="#" class="mx-4 hover:text-sky-200"><i data-feather="twitter"></i></a>
				<a href="#" class="mx-4 hover:text-sky-200"><i data-feather="facebook"></i></a>
				<a href="#" class="mx-4 hover:text-sky-200"><i data-feather="github"></i></a>
				<a href="#" class="mx-4 hover:text-sky-200"><i data-feather="instagram"></i></a>
			</div>
		</div>
	</footer>
	<!-- Footer End -->

	<!-- My Javascript -->
	<script src="dist/script.js"></script>

	// cek apakah tombol sudah ditekan atau belum
	<?php if( isset($_POST["submit"]) ) : ?>
		// cek apakah data berhasil diedit atau tidak berhasil
		<?php if( edit($_POST) > 0 ) : ?>
			<script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
			<script>
				Swal.fire({
					title: 'Yeay!',
					icon: 'success',
					text: 'Data Berhasil di Edit!',
					showConfirmButton: false,
					timer: 1500
				});
				setTimeout(() => {
				document.location.href = 'index_bendahara.php';				
			}, 1500);
			</script>
			<?php else : ?>
				<script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
			<script>
				Swal.fire({
					title: 'Yeay!',
					icon: 'warning',
					text: 'Data Gagal di Edit!',
					showConfirmButton: false,
					timer: 1500
				});
				setTimeout(() => {
				document.location.href = 'index_bendahara.php';				
			}, 1500);
			</script>
		<?php endif; ?>
	<?php endif; ?>

	<!-- My Icons -->
	<script>
		feather.replace();
	</script>

	<!-- AOS -->
	<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
	<script>
		AOS.init();
	</script>

</body>

</html>