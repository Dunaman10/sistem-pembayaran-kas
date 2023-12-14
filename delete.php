<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location:index_bendahara.php");
		exit;
}

require 'functions.php';

$id = $_GET["id"];

// if( delete($id) > 0 ) {
// 	echo "
// 			<script>
// 				alert('Data Berhasil di Hapus');
// 				document.location.href = 'index_bendahara.php';
// 			</script>
// 		";
// } else {
// 	echo "
// 			<script>
// 				alert('Data Gagal di Hapus');
// 				document.location.href = 'index_bendahara.php';
// 			</script>
// 		";
// }



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<!-- Tailwind CSS -->
	<script src="https://cdn.tailwindcss.com"></script>

	<!-- Sweet Alert -->
	<link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.js">
	<link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">

</head>
<body>

	<?php if( delete($id) > 0 ) : ?>
		<script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
			<script>
				Swal.fire({
					icon: 'success',
					text: 'Data Berhasil di Hapus',
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
					icon: 'success',
					text: 'Data Gagal di Hapus',
					showConfirmButton: false,
					timer: 1500
				});
				setTimeout(() => {
				document.location.href = 'index_bendahara.php';				
			}, 1500);
			</script>
	<?php endif; ?>

</body>
</html>