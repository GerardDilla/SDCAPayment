
<div style="background-image: url('<?php echo base_url(); ?>assets/img/webbanner.jpg');
height: 100%;
background-attachment: fixed;
background-repeat: no-repeat;
background-position: center;
background-size: cover;
position: fixed;
width: 100%;
">
</div>
<div class="set-full-height" >
	<!--   Creative Tim Branding   -->
	<a  >
			<div class="logo-container">
			<div class="logo">
				<img src="<?php echo base_url(); ?>assets/img/logo-header.png">
			</div>
		</div>
	</a>

	<!--   Big container   -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-5 col-sm-offset-1">
				<!--      Wizard container        -->
				<div class="wizard-container">
					<div class="card wizard-card" data-color="green" id="wizardProfile" style="margin-top:15%; text-align:center">
						<div class="wizard-header">
							<br><br><br>
							<h3 class="wizard-title">
								LOADING
							</h3>
							<h5>Redirecting you to Payment</h5>
							<img src="<?php echo base_url(); ?>assets/img/YCZH.gif" width="70%" height="auto">
						</div>
						
						<form id="payment_confirmation" name="payment_confirmation" action="https://secureacceptance.cybersource.com/pay" style="text-align:center" method="post"/>
						<?php

							//echo json_encode($this->data['paymentform']);
							foreach($this->data['paymentform'] as $name => $value) {
								echo "<input type=\"hidden\" id=\"" . $name . "\" name=\"" . $name . "\" value=\"" . $value . "\"/>\n";
								echo '<br>';
							}
						?>
						
						</form>
						<!--
						<table class="table" style="width:100%; font-size:100%">
								<tr>
									<td style="text-align:right; font-weight:400">Reference Number:</td>
									<td style="text-align:left"><?php echo $this->session->userdata('refnum'); ?></td>
									
								</tr>
								<tr>
									<td style="text-align:right; font-weight:400">Email:</td>
									<td style="text-align:left"><?php echo $this->session->userdata('email'); ?></td>
									
								</tr>
								<tr>
									<td style="text-align:right; font-weight:400">Amount:</td>
									<td style="text-align:left">Php <?php echo $this->session->userdata('amount'); ?></td>
								</tr>
						</table>
						-->
					</div>
				</div> <!-- wizard container -->
			</div>
		</div><!-- end row -->
	</div> <!--  big container -->

	<div class="footer">
		<div class="container text-center">
			
		</div>
	</div>
</div>

<script>

window.onload = function(){

  document.forms['payment_confirmation'].submit();

}


</script>


