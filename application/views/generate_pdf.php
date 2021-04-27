<!DOCTYPE html>
<html>
<head>

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i" rel="stylesheet">
<style>
#HTMLtoPDF {
    font-size: 13px;
    font-family: Helvetica,Arial,sans-serif !important;
    font-style: normal;
    letter-spacing: 0;
    color: #000000;
} 
</style>
</head>


<body style="opacity: 0">
    <div id="HTMLtoPDF">
	    <?php echo $mailtemplate; ?>
    </div>


    <script src="<?php echo base_url(); ?>assets/js/html2pdf/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/html2pdf/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/html2pdf/kendo.all.min.js"></script>
	<script>
	(function() {
		ExportPdf();
		
	}());

	function ExportPdf() {
		kendo.drawing
		.drawDOM('#HTMLtoPDF', {
			paperSize: "A4",
			margin: {top: "1cm", bottom: "1cm", right: "1cm", left: "1cm"},
			scale: 0.70,
			height: 500
		})
		.then(function(group){
			kendo.drawing.pdf.saveAs(group, "Reservation.pdf");
		});
	}
	</script>

</body>
</html>