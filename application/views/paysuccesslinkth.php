<html>
<head>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/home/styles/hotel-page.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/home/styles/timeline-page.css">

	<style>

		.width-650{
			margin: 0 auto;
		}

		.manual-content .heading{
			text-align: center;
			color: #fff;
		}

		.faq-page{
			display: flex;
			flex-direction: column;
		}

		.faq-page{
			margin: 0 auto;
		}

		.faq-login{
			flex-grow:1;
		}

		.panel {
			padding: 0 18px;
			background-color: transparent !important;
			color: #fff !important;
			border:   1px solid transparent !important;
			box-shadow: none !Important;
		}

		/*.panel p{*/
		/*	margin: 18px 0;*/
		/*	font-family: 'caption-light', sans-serif;*/
		/*}*/

		.svg-overflow svg{
			overflow: visible;
		}

		.background-yankee .active, .background-yankee .accordion:hover {
			background-color: #18386663;
		}

		.background-green .active, .background-green .accordion:hover {
			background-color: #66a694;
		}


	</style>

</head>

<script>

	function capenable() {
		document.getElementById("capsubmit").style.display = "block";
	}

	function capdisable() {
		document.getElementById("capsubmit").style.display = "none";
	}


</script>
<script src='https://www.google.com/recaptcha/api.js' async defer ></script>

</head>

<style type="text/css">
	input[type="checkbox"] {
		zoom: 3;
	}

	@media screen and (max-width: 680px) {
		.columns .column {
			flex-basis: 100%;
			margin: 0 0 5px 0;
		}
	}
	.selectWrapper {
		border-radius: 50px;
		overflow: hidden;
		background: #eec5a7;
		border: 0px solid #ffffff;
		padding: 5px;
		margin: 0px;
	}

	.selectBox {
		background: #eec5a7;
		width: 100%;
		height: 25px;
		border: 0px;
		outline: none;
		padding: 0px;
		margin: 0px;
	}
</style>

<body>
<!-- end header -->

<script src='https://www.google.com/recaptcha/api.js' async defer ></script>

<div class="main-wrapper">
	<div class="col-half background-orange-light height-100">
		<div class="flex-column align-start">
			<div align="left">
				<h2 class="heading mb-35">
					BEDANKT VOOR DE ORDER, SCAN OPNIEUW OM DE VOLGENDE ORDER TE PLAATSEN.
					<h5 class="heading mb-35">
						JE DRINKEN STAAT KLAAR BIJ DE BAR.
					</h5>
					<p><br></p>
					<h5 class="heading mb-35">
						ETEN BESTELD JE KRIJGT EEN SMS EN KAN HET DAARNA OPHALEN BIJ DE KEUKEN.
					</h5>
				</h2>
			</div>

			<div align="left">

			</div>

			<div class="mt-50" align="center" >
				<img border="0" src="<?php echo base_url(); ?>assets/home/images/tiqslogowhite.png" alt="tiqs" width="350" height="auto" />
			</div>
			<div class="mt-50" align="center" >
				<img border="0" src="<?php echo base_url(); ?>assets/home/images/alfredmenu.png" alt="tiqs" width="350" height="auto" />
			</div>

		</div>
	</div><!-- end col half -->

	<div class="col-half background-blue timeline-content">
		<div class="timeline-block background-blue">
			<div class="timeline-text">
				<div class="timeline-heading">
					<h2 style="font-weight:bold; font-family: caption-bold">VRAGEN?</h2>
				</div>
				<p class="text-content-light" style="font-size: larger">JE KAN MET ONS CONTACT OPNEMEN ALS JE VRAGEN HEBT OVER DEZE ORDER. </p>
				<!--<span class="cd-date">Feb 18</span>-->
				<div class="flex-column align-space">
					<p class="text-content-light" style="font-size: larger">SEND E-MAIL TO SUPPORT@TIQS.COM</p>

				</div>
			</div>
		</div><!-- end timeline block -->
	</div>
	<!-- time-line -->
	<!-- end col half -->
</div>
<!-- end main wrapper -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>
<?php
if(isset($_SESSION['error'])){
	unset($_SESSION['error']);
}
if(isset($_SESSION['success'])){
	unset($_SESSION['success']);
}
if(isset($_SESSION['message'])){
	unset($_SESSION['message']);
}
?>
