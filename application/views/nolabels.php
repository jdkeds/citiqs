<div style="margin-top: 0;" class="main-wrapper">
	<div class="col-half width-650 background-apricot-blue height-100">
		<div class="flex-column align-start">
			<div class="mt-50" style="text-align:left; margin-left: -30px">
				<img src="<?php echo base_url(); ?>assets/home/images/tiqslogowhite.png" alt="tiqs" width="300" height="auto" />
			</div>
			<div style="text-align:left; margin-top: 30px">
				<h1 class="heading" style="font-size: 400%; margin-bottom: 20px">
					DIGITALLY
<!--					--><?php //echo $this->language->tline('DIGITALLY');?>
				</h1>
				<h3 class="heading">
					CONNECT WITH YOUR VISITORS
<!--					--><?php //echo $this->language->tline('CONNECT WITH YOUR VISITORS');?>
				</h3>
			</div>

		</div>

	</div><!-- end col half -->


</div>


<div class="modal" id="quickModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<form method="post" action="<?php echo base_url() ?>quicksettings/<?php echo $vendor['vendorId']; ?>">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" style="color:#000; text-align:center">
						PLEASE ANSWER THE FOLLOWING SETTINGS QUESTIONS
					</h4>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-primary" value="Submit" />
				</div>
			</div>
		</form>
	</div>
</div>




<!-- end main wrapper -->
<script>
	// modal script
	// Get the modal
	var modal = document.getElementById("myModal");

	// Get the button that opens the modal
	var btn = document.getElementById("modal-button");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	if (btn) {
		// When the user clicks on the button, open the modal
		btn.onclick = function() {
			if (modal) {
				modal.style.display = "block";
			}
		}
	}

	if (span) {
		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
			modal.style.display = "none";
		}
	}
	

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}

	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
		acc[i].addEventListener("click", function() {
			this.classList.toggle("active");
			var panel = this.nextElementSibling;
			if (panel.style.maxHeight) {
				panel.style.maxHeight = null;
				panel.style.border = 'none';
			} else {
				panel.style.maxHeight = panel.scrollHeight + "px";
				/* panel.style.border = '1px solid #ffffff4a';
				   panel.style.borderTop = 'none';
				   panel.borderTopLeftRadius = 0 + 'px';
				   panel.borderTopRightRadius = 0 + 'px';*/
			}
		});
	}

	$('#show-timeline-video-2').click(function(){
		console.log('da');
		$('#timeline-video-2').toggleClass('show');
	})

	$('#show-timeline-video-3').click(function(){
		console.log('da');
		$('#timeline-video-3').toggleClass('show');
	})

	$('#show-timeline-video-4').click(function(){
		console.log('da');
		$('#timeline-video-4').toggleClass('show');
	})

</script>
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
