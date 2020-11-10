<!DOCTYPE html>
<html lang="<?php echo $_SESSION['site_lang']; ?>">

<head>
	<title><?php echo $pageTitle ? $pageTitle : 'TIQS | SHOP'; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta charset="UTF-8" />
	
	<link rel="shortcut icon" href="<?php echo $this->baseUrl; ?>assets/home/images/tiqsiconlogonew.png" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/bower_components/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/main-style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/grid.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>tiqscss/tiqsballoontip.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/tiqscss.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>tiqscss/clstylesheet.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>tiqscss/cbstylesheet.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/cookie.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/how-it-works.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/home-page.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/dist/css/AdminLTE.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/styleonboard.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" integrity="sha256-PZLhE6wwMbg4AB3d35ZdBF9HD/dI/y4RazA3iRDurss=" crossorigin="anonymous" />
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl; ?>assets/home/styles/keyboard.css" />
	<?php include_once FCPATH . 'application/views/includes/customCss.php'; ?>

	<script src="<?php echo $this->baseUrl; ?>assets/home/js/jspdf.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'></script>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha256-P93G0oq6PBPWTP1IR8Mz/0jHHUpaWL0aBJTKauisG7Q=" crossorigin="anonymous"></script>
	<script src="<?php echo $this->baseUrl; ?>assets/dist/js/tooltipster.bundle.min.js"></script>
	<script src="<?php echo $this->baseUrl; ?>assets/home/js/vanilla-picker.js"></script>
	<script src="<?php echo $this->baseUrl; ?>assets/home/js/cookies.js"></script>
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
	<script src="<?php echo $this->baseUrl; ?>assets/home/js/alertify.js"></script>
	<script src="<?php echo $this->baseUrl; ?>assets/home/js/keyboard.js"></script>
	<script src="<?php echo $this->baseUrl; ?>assets/home/js/scriptonboard.js"></script>
	<?php include_once FCPATH . 'application/views/includes/customJs.php'; ?>
</head>

<?php if ($this->view === 'map') {?>
<body onload="getLocation()">
<?php } else { ?>
<body>


<?php } ?>
<header class="header">
	<nav class="header-nav" style="background-color: #0d173b">
		<a href="<?php echo base_url(); ?>start" class="nav-logo">
			<img src="<?php echo base_url(); ?>assets/home/images/tiqslogowhite.png" alt="">
		</a>
		<div class="header-menu" id="header-menu" align="right">
			<a style="color: #FFFFFF" href="<?php echo $this->baseUrl; ?>home#dhl-section" id='dhl-button'></a>
			<a style="color: #FFFFFF" href="<?php echo $this->baseUrl; ?>found"></a>
			<a style="color: #FFFFFF" href="<?php echo $this->baseUrl; ?>check424"><img width="30px" height="30px" src="<?php echo $this->baseUrl; ?>assets/home/images/visitor.png" title="CHECK424"/></a>
			<a style="color: #FFFFFF" href="#" id='modal-button'><img width="30px" height="30px" src="<?php echo $this->baseUrl; ?>assets/home/images/world.png" title="REPORTS"/></a>
			<a style="color: #FFFFFF" href="<?php echo $this->baseUrl; ?>registerbusiness">REGISTER</a>
			<a style="color: #FFFFFF" href="<?php echo $this->baseUrl; ?>login">LOGIN</a>
		</div>
		<div class="hamburger-menu" id="hamburger-menu">
			<div></div>
			<div></div>
			<div></div>
		</div>
	</nav>
</header>
<div id="top" >
<!--	<a  ></a>-->
.
</div>
