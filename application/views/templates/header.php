<html>
	<head>
		<title>Mon application php</title>
		<link rel="stylesheet" href="<?= base_url() . "assets/css/bootstrap.css"?>" />
	</head>
	<body>
	<?php
		$visitor = $this->session->cpt_status;

		if($visitor == 'A') $this->load->view('templates/nav_admin');
		else if($visitor == 'N') $this->load->view('templates/nav_seller');
		else $this->load->view('templates/nav');
	?>
		<div class="container mt-3">
