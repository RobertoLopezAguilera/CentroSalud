<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<title>Agendar Cita</title>

	<style>
		.principal {
			display: flex;
			justify-content: center;
			align-items: center;
			width: 100%;
			height: 100%;
			flex-direction: column;
			background-image: url("https://clinicaeusalud.com.co/wp-content/uploads/2022/05/elderly-woman-doctor-appointment-in-modern-private-clinic-while-she-sitts-on-hospital-bed-and-the-physician-is-listening-her-heart-beat-health-care-medicine-treatment-specialist-consultation-scaled.jpg");
			background-repeat: no-repeat;
			background-size: cover;
		}

		.principal_agendar {
			color: black;
			text-shadow: -1px -1px 0 rgb(255, 255, 255),
				1px -1px 0 rgb(255, 255, 255),
				-1px 1px 0 rgb(255, 255, 255),
				1px 1px 0 rgb(255, 255, 255);
		}
	</style>
</head>

<body>
	<?php include 'assets/header.php'; ?>
	<div id="header"></div>

	<div class="principal">
		<section class="section_principal">
			<div class="principal_agendar">
				<h1 class="h_agendar">Consulta médica</h1>
				<p>Para brindar tratamientos oportunos y preventivos</p>
				<svg xmlns="http://www.w3.org/2000/svg" width="62.5" height="50" viewBox="0 0 640 512">
					<path fill="#4f46e5"
						d="M232 224h56v56a8 8 0 0 0 8 8h48a8 8 0 0 0 8-8v-56h56a8 8 0 0 0 8-8v-48a8 8 0 0 0-8-8h-56v-56a8 8 0 0 0-8-8h-48a8 8 0 0 0-8 8v56h-56a8 8 0 0 0-8 8v48a8 8 0 0 0 8 8M576 48a48.14 48.14 0 0 0-48-48H112a48.14 48.14 0 0 0-48 48v336h512zm-64 272H128V64h384zm112 96H381.54c-.74 19.81-14.71 32-32.74 32H288c-18.69 0-33-17.47-32.77-32H16a16 16 0 0 0-16 16v16a64.19 64.19 0 0 0 64 64h512a64.19 64.19 0 0 0 64-64v-16a16 16 0 0 0-16-16" />
				</svg>
				<h3 class="elementor-image-box-title">Agenda una cita al</h3>
				<p class="elementor-image-box-description">+123 456 7890</p>
			</div>
			<div class="agendar">
			<button class="button-29" onclick="confirmAction()">Agendar Cita</button>

<!-- SweetAlert2 JS -->
<script src="Ventana_Confirmar/sweetalert.js"></script>
<script>
	function confirmAction() {
		Swal.fire({
			title: '¿Cuentas con una cuenta?',
			showCancelButton: true,
			confirmButtonText: 'Sí',
			cancelButtonText: 'No',
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = "login.php";
			} else {
				window.location.href = "agregar_paciente.php";
			}
		});
	}
</script>
			</div>
		</section>
		<section class="section_principal">
			<div class="principal_agendar">
				<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
					<g fill="none" stroke="#4f46e5" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
						color="#4f46e5">
						<path
							d="M18 18c1.245.424 2 .982 2 1.593C20 20.923 16.418 22 12 22s-8-1.078-8-2.407c0-.611.755-1.169 2-1.593m9-8.5a3 3 0 1 1-6 0a3 3 0 0 1 6 0" />
						<path
							d="M12 2c4.059 0 7.5 3.428 7.5 7.587c0 4.225-3.497 7.19-6.727 9.206a1.55 1.55 0 0 1-1.546 0C8.003 16.757 4.5 13.827 4.5 9.587C4.5 5.428 7.941 2 12 2" />
					</g>
				</svg>
				<p class="elementor-image-box-description">
					<br> Calle. Aguascalientes #797, Moroleón, Gto. C.P 38870
				</p>
			</div>
		</section>
	</div>
	<?php include 'assets/footer.html'; ?>
	<div id="footer"></div>
</body>

</html>