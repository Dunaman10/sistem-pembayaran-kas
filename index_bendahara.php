<?php

session_start();

$db = mysqli_connect("localhost", "root", "", "spk");

if(!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

$user_id = $_SESSION['login'];
$ambil = "SELECT * FROM user WHERE id = $user_id";
$result = $db->query($ambil);

if ($result->num_rows == 1) {
	$row = $result->fetch_assoc();
	$nama = $row['nama'];
	$nim = $row['nim'];
} else {
	echo "Data mahasiswa tidak ditemukan.";
}

$db->close();

require 'functions.php';

// ambil data dari tabel mahasiswa atau query
$mahasiswa = query("SELECT * FROM mahasiswa");

// Mendapatkan bulan dan tahun saat ini
$bulan_sekarang = 'NOVEMBER';
$tahun_sekarang = '2023';

?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sistem Pembayaran Kas</title>

	<!-- Icon Unpam -->
	<link rel="icon" href="dist/img/logo-unpam.png">

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

	<!-- Header Start -->
	<header class="bg-slate-200 bg-opacity-50 fixed top-0 left-0 w-full flex items-center z-10">
		<div class="container">
			<div class="flex items-center justify-between relative">
				<div class="px-8">
					<a href="#home" class="font-bold text-2xl lg:text-4xl block py-6"><span
							class="bg-gradient-to-l from-sky-600 to-sky-400 bg-clip-text text-transparent">03TPLP016</span></a>
				</div>

				<div class="flex items-center px-4">
					<button id="hamburger" name="hamburger" class="block absolute right-4 lg:hidden">
						<span class="hamburger-line transition duration-300 ease-in-out origin-top-left"></span>
						<span class="hamburger-line transition duration-300 ease-in-out"></span>
						<span class="hamburger-line transition duration-300 ease-in-out origin-bottom-left"></span>
					</button>
				</div>

				<nav id="nav-menu"
					class="hidden absolute py-5 bg-white shadow-xl shadow-sky-200 rounded-lg max-w-[250px] w-full right-4 top-full lg:block lg:static lg:bg-transparent lg:max-w-full lg:shadow-none lg:rounded-none">
					<ul class="block lg:justify-end lg:flex">
						<li class="group">
							<a href="#home" class="text-sky-700 py-2 mx-8 group-hover:text-sky-500 font-semibold flex"><span
									class="mx-auto">HOME</span></a>
						</li>
						<li class="group">
							<a href="#about" class="text-sky-700 py-2 mx-8 group-hover:text-sky-500 font-semibold flex"><span
									class="mx-auto">ABOUT</span></a>
						</li>
						<li class="group">
							<a href="#bayar" class="text-sky-700 py-2 mx-8 group-hover:text-sky-500 font-semibold flex"><span
									class="mx-auto">BAYAR</span></a>
						</li>
						<li class="group">
							<a href="#mahasiswa" class="text-sky-700 py-2 mx-8 group-hover:text-sky-500 font-semibold flex"><span
									class="mx-auto">MAHASISWA</span></a>
						</li>
						<li class="group">
							<a href="logout.php"
								class="text-slate-200 transition ease-in-out delay-150 bg-sky-500 hover:-translate-y-1 hover:scale-110 hover:bg-sky-600 duration-300 py-2 mx-8 font-semibold flex rounded-md">
								<span class="px-5 mx-auto">LOGOUT</span></a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</header>
	<!-- Header End -->

	<!-- Profil Start -->
	<section class="fixed right-10 bottom-28 w-16 h-16 shadow-lg rounded-full">
		<button id="profil" name="profil"
			class="transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300">
			<img id="gambar-profil" src="dist/img/profil.png" alt="" class="rounded-full z-50">
		</button>
		<div id="detail-profil"
			class="hidden fixed w-64 h-20 bg-white shadow-xl shadow-sky-200 right-10 bottom-[12rem] rounded-3xl rounded-br-none">
			<div class="p-2 text-center text-sky-500 text-lg">
				<p><?= $nama; ?></p>
				<p class="mb-3"><?= $nim; ?></p>
			</div>
		</div>
	</section>
	<!-- Profil End -->

	<!-- Home Start -->
	<section class="pt-24 min-h-screen" id="home">
		<div class="container lg:mx-auto lg:flex md:block sm:block items-center">
			<div class="mx-auto px-6 text-center">
				<h1 class="font-bold text-2xl lg:text-4xl"><span
						class="bg-gradient-to-l from-sky-600 to-sky-400 bg-clip-text text-transparent" data-aos="zoom-out"
						data-aos-duration="1500">Selamat Datang di Portal Uang
						Kas Kelas!</span></h1>
				<p class="text-xl mx-10 text-justify" data-aos="zoom-out" data-aos-duration="1500">Ini adalah tempat di mana
					Anda dapat dengan mudah dan efisien mengelola
					keuangan
					kelas! Kami
					mengundang Anda
					untuk bersama-sama mewujudkan kelas yang teratur dan transparan melalui sistem kas kelas modern kami. Di sini,
					Anda dapat mencatat, menghitung, dan berbagi informasi keuangan kelas dengan solusi terbaik, memberikan
					fondasi yang kuat untuk kolaborasi dan keterbukaan.</p>
				<div class="flex flex-wrap gap-2 mt-4 justify-center">
					<img src="dist/img/1.jpg" alt="" class="w-80 rounded-lg shadow-lg" data-aos="fade-up"
						data-aos-duration="1500">
					<img src="dist/img/3.jpg" alt="" class="w-80 rounded-lg shadow-lg" data-aos="fade-up"
						data-aos-duration="1600">
					<img src="dist/img/2.jpg" alt="" class="w-80 rounded-lg shadow-lg" data-aos="fade-up"
						data-aos-duration="1700">
					<img src="dist/img/4.jpg" alt="" class="w-80 rounded-lg shadow-lg" data-aos="fade-up"
						data-aos-duration="1800">
					<img src="dist/img/5.jpg" alt="" class="w-80 rounded-lg shadow-lg" data-aos="fade-up"
						data-aos-duration="1900">
					<img src="dist/img/6.jpg" alt="" class="w-80 rounded-lg shadow-lg" data-aos="fade-up"
						data-aos-duration="2000">
					<img src="dist/img/7.jpg" alt="" class="w-80 rounded-lg shadow-lg" data-aos="fade-up"
						data-aos-duration="2100">
					<img src="dist/img/8.jpg" alt="" class="w-80 rounded-lg shadow-lg" data-aos="fade-up"
						data-aos-duration="2200">
				</div>
			</div>
		</div>
	</section>
	<!-- Home End -->

	<!-- About Start -->
	<section class="pt-36 min-h-screen sm:pt-24 lg:pt-40 hover:text-sky-200" id="about">
		<div class="container lg:mx-auto lg:flex md:block sm:block items-center justify-center lg:px-12">
			<div class="text-center px-6" data-aos="fade-up" data-aos-duration="1500">
				<h1 class="text-slate-800 font-bold text-2xl">ABOUT</h1>
				<p class="text-slate-800 font-light text-lg">Di tengah gemerlapnya kampus, kita menjalani perjalanan pendidikan
					penuh tantangan. Setiap hari, kita penuhi kelas dengan semangat belajar, mengasah keterampilan, dan membentuk
					persahabatan yang tak terlupakan. Di sini, kita tidak hanya mengejar impian, tetapi juga membentuk masa depan
					cerah dengan tekad bersama.</p>
			</div>
			<div class="mx-8 pt-6 pb-6" data-aos="fade-down" data-aos-duration="1500">
				<img src="dist/img/mahasiswa-016.jpg" alt="Home"
					class="w-[40rem] lg:w-[60rem] rounded-lg shadow-lg md:mx-auto sm:mx-auto">
			</div>
		</div>
	</section>
	<!-- About End -->

	<!-- Qris Start -->
	<section class="pt-12 min-h-screen" id="bayar">
		<div class="container lg:mx-auto lg:flex md:block sm:block items-center justify-center">
			<div class="mx-8" data-aos="fade-down" data-aos-duration="1500">
				<img src="dist/img/qris.png" alt="Qris" class="w-[30rem] rounded-lg shadow-lg md:mx-auto sm:mx-auto">
			</div>
			<div class="text-center pt-6 px-6" data-aos="fade-up" data-aos-duration="1500">
				<h1 class="text-slate-800 font-bold text-2xl mb-1">Cara Membayar Uang Kas</h1>
				<ul class="text-slate-800 font-light text-lg text-start list-disc mx-3">
					<li>Scan Barcode di Samping</li>
					<li>Masukkan Nominal Uang Kas Sebesar Rp.5000</li>
					<li>Screenshot Bukti Pembayaran Anda</li>
					<li>Kirim Bukti Pembayaran Anda ke Bendahara Melalui Whatsapp</li>
				</ul>
				<a href="https://wa.me/+6285810405485" target="blank"
					class="text-slate-200 transition ease-in-out delay-150 bg-[#25D366] hover:-translate-y-1 hover:scale-110 hover:bg-[#4CAF50] duration-300 py-2 font-semibold flex rounded-md mt-2 w-52"><span
						class="px-5 mx-auto">Hubungi Bendahara</span></a>
			</div>
		</div>
	</section>
	<!-- Qris End -->

	<!-- Mahasiswa Start -->
	<section class="pt-36 min-h-screen" id="mahasiswa">
		<div class="container" data-aos="fade-up" data-aos-duration="1500">
			<h1 class="text-center text-slate-800 font-bold text-2xl"><span
					class="bg-gradient-to-l from-sky-600 to-sky-400 bg-clip-text text-transparent">KAS KELAS BULAN
					<?= $bulan_sekarang ?> </span>
			</h1>

			<div align="center" class="mx-2 mt-8 overflow-auto h-96">
				<table class="table-auto border-collapse border border-slate-700 min-w-full text-center">
					<thead class="bg-gradient-to-l from-sky-600 to-sky-400 text-slate-200">
						<tr>
							<th rowspan="2" class="lg:px-6 md:px-3 sm:px-1 lg:py-3 border border-slate-700">No</th>
							<th rowspan="2" class="lg:px-6 md:px-3 sm:px-1 lg:py-3 border border-slate-700">Nama</th>
							<th rowspan="2" class="lg:px-6 md:px-3 sm:px-1 lg:py-3 border border-slate-700">Nim</th>
							<th colspan="3" class="pt-3 py-3 border border-slate-700">Tanggal</th>
							<th rowspan="2" class="lg:px-6 md:px-3 sm:px-1 lg:py-3 border border-slate-700">Edit</th>
							<th rowspan="2" class="lg:px-6 md:px-3 sm:px-1 lg:py-3 border border-slate-700">Delete</th>
						<tr>
							<th class="lg:px-6 md:px-3 sm:px-1 py-4 border border-slate-700">06/11/2023</th>
							<th class="lg:px-6 md:px-3 sm:px-1 py-4 border border-slate-700">13/11/2023</th>
							<th class="lg:px-6 md:px-3 sm:px-1 py-4 border border-slate-700">20/11/2023</th>
						</tr>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach( $mahasiswa as $row ) : ?>
						<tr>
							<td class="px-6 py-3 border border-slate-700"><?= $i; ?></td>
							<td class="px-6 py-3 border border-slate-700"><?= $row["nama"]; ?></td>
							<td class="px-6 py-3 border border-slate-700"><?= $row["nim"]; ?></td>
							<td class="px-6 py-3 border border-slate-700"><?= $row["tanggal1"]; ?></td>
							<td class="px-6 py-3 border border-slate-700"><?= $row["tanggal2"]; ?></td>
							<td class="px-6 py-3 border border-slate-700"><?= $row["tanggal3"]; ?></td>
							<td class="px-6 py-3 border border-slate-700"><a href="edit.php?id=<?= $row["id"]; ?>"
									class="hover:text-sky-500 lg:flex lg:justify-center"><i data-feather="edit"></i></a>
							</td>
							<td class="px-6 py-3 border border-slate-700"><a href="delete.php?id=<?= $row["id"]; ?>"
									class="tombol-hapus hover:text-sky-500 lg:flex lg:justify-center"><i data-feather="trash-2"></i></a>
							</td>
						</tr>
						<?php $i++; ?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="flex justify-center my-4">
				<a href="add.php"
					class="transition ease-in-out delay-150 bg-sky-500 hover:-translate-y-1 hover:scale-110 hover:bg-sky-600 duration-300 p-2 rounded-xl text-white">Add
					Mahasiswa</a>
			</div>
		</div>
	</section>
	<!-- Mahasiswa End -->

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
	<script src="dist/script_bendahara.js"></script>

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