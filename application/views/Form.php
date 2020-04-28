<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/img/favicon.ico">

	<title>St. Dominic College of Asia Online Payment</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/img/apple-icon.png" />
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/img/favicon.png" />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
	

	<!-- CSS Files -->
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="<?php echo base_url(); ?>assets/css/demo.css" rel="stylesheet" />
</head>

<body>
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
	    <a href="http://creative-tim.com">
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
		                <div class="card wizard-card" data-color="green" id="wizardProfile" style="margin-top:15%">
		                    <form action="" method="">
		                <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

		                    	<div class="wizard-header">
		                        	<h3 class="wizard-title">
		                        	   Payment Form
		                        	</h3>
									<h5>Fill out the form to proceed with the payment</h5>
		                    	</div>
								<div class="wizard-navigation">
									<ul>
			                            <li><a href="#about" data-toggle="tab">Basic Info</a></li>
			                            <li><a href="#account" data-toggle="tab">Academic Info</a></li>
			                            <li><a href="#address" data-toggle="tab">Contact Details</a></li>
			                        </ul>
								</div>

		                        <div class="tab-content">
		                            <div class="tab-pane" id="about">
		                                <div class="row">
		                                	<h4 class="info-text"> Please answer the form below</h4>
		                                	<div class="col-sm-10 col-sm-offset-1">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">looks_one</i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Student First Name <small>(required)</small></label>
			                                          <input id="firstName" name="firstname" type="text" class="form-control">
			                                        </div>
												</div>

												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">looks_two</i>
													</span>
													<div class="form-group label-floating">
													  <label class="control-label">Student Middle Name <small></small></label>
													  <input name="middlename" type="text" class="form-control">
													</div>
												</div>

												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">looks_3</i>
													</span>
													<div class="form-group label-floating">
													  <label class="control-label">Student Last Name <small>(required)</small></label>
													  <input id="lastName" name="lastname" type="text" class="form-control">
													</div>
												</div>
											</div>
		                                	<div class="col-sm-10 col-sm-offset-1">
												<div class="col-sm-6">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">person</i>
														</span>
														<div class="form-group label-floating">
															<label class="control-label">Reference Number <small>(required)</small></label>
															<input id="referenceNumber" name="referencenumber" type="text" class="form-control">
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">person</i>
														</span>
														<div class="form-group label-floating">
															<label class="control-label">Student Number</label>
															<input name="studentnumber" type="text" class="form-control">
														</div>
													</div>
												</div>
		                                	</div>
		                            	</div>
		                            </div>
		                            <div class="tab-pane" id="account">
		                                <h4 class="info-text"> Select the Student's Academic Background </h4>
		                                <div class="row">
		                                    <div class="col-sm-10 col-sm-offset-1" id="choiceparent">
												<h4 style="text-align:center; color:#008000">testewrtewrwerew</h4>
		                                        <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-checkbox">
		                                                <input type="checkbox" class="uniqueCheckbox studentType" name="educationtype[]" value="basiced">
		                                                <div class="icon">
		                                                    <i class="fa fa-pencil"></i>
		                                                </div>
		                                                <h6>Basic Education</h6>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-checkbox">
		                                                <input type="checkbox" class="uniqueCheckbox studentType" name="educationtype[]" value="basiced">
		                                                <div class="icon">
		                                                    <i class="fa fa-users"></i>
		                                                </div>
		                                                <h6>Senior Highscool</h6>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-checkbox">
		                                                <input type="checkbox" class="uniqueCheckbox studentType" name="educationtype[]" value="highered">
		                                                <div class="icon">
		                                                    <i class="fa fa-laptop"></i>
		                                                </div>
		                                                <h6>Higher Education</h6>
		                                            </div>
		                                        </div>
		                                    </div>
										</div>
										<hr>
										<h4 class="info-text"> Input the Student's Academic Info </h4>
		                                <div class="row">
		                                	<div class="col-sm-10 col-sm-offset-1">

												<div class="col-sm-12">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">local_library</i>
														</span>
														<div class="form-group label-floating">
														<label class="control-label">Program / Strand</label>
														<input name="program" type="text" class="form-control">
														</div>
													</div>
												</div>

												<div class="col-sm-12">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">school</i>
														</span>
														<div class="form-group label-floating">
														<label class="control-label">Year Level / Grade Level <small>(required)</small></label>
														<input name="yearlevel" type="text" class="form-control">
														</div>
													</div>
												</div>

												<div class="col-sm-12">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">calendar_today</i>
														</span>
														<div class="form-group label-floating">
															<label class="control-label">School Year <small>(required)</small></label>
															<select name="schoolyear" class="form-control">
																<option disabled="" selected=""></option>
																<option>2019-2020</option>
																<option>2020-2021</option>
															</select>
														</div>
													</div>
												</div>

												<div class="col-sm-12">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="material-icons">book</i>
														</span>
														<div class="form-group label-floating">
														<label class="control-label">Semester / Term <small>(required)</small></label>
														<input name="semester" type="text" class="form-control">
														</div>
													</div>
												</div>

												
											</div>
		                            	</div>
		                            </div>
		                            <div class="tab-pane" id="address">
		                                <div class="row">
		                                    <div class="col-sm-12">
		                                        <h4 class="info-text"> Please fill-out your contact details </h4>
		                                    </div>
											<div class="col-sm-10 col-sm-offset-1">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">contact_phone</i>
													</span>
													<div class="form-group label-floating">
													<label class="control-label">Contact Number <small>(required)</small></label>
													<input name="contactnumber" type="text" class="form-control">
													</div>
												</div>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">contact_mail</i>
													</span>
													<div class="form-group label-floating">
													<label class="control-label">Email <small>(required)</small></label>
													<input name="email" type="email" class="form-control">
													</div>
												</div>
											</div>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="wizard-footer">
		                            <div class="pull-right">
		                                <input type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' value='Next' />
		                                <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd paymentsubmit' name='finish' value='Proceed to Payment' />
		                            </div>

		                            <div class="pull-left">
		                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
		                            </div>
		                            <div class="clearfix"></div>
		                        </div>
		                    </form>
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

	<input type="hidden" id="addressUrl" value="<?php print site_url().'/main'; ?>" />

</body>
	<!--   Core JS Files   -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.bootstrap.js" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src="<?php echo base_url(); ?>assets/js/material-bootstrap-wizard.js"></script>

    <!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
 
	<script src="<?php echo base_url(); ?>assets/js/customscript.js"></script>

	<!-- Wirecard -->
	<script type=text/javascript src="https://wpp-test.wirecard.com/loader/paymentPage.js"></script>
	
	<!-- Custom -->
	<script src="<?php echo base_url(); ?>js/online_payment.js" type="text/javascript"></script>

</html>

<script type='text/javascript'>

	var baseurl = '<?php echo base_url(); ?>';
	
    $(document).ready(function(){

        $('.paymentsubmit').click(function(e){
        	var $valid = $('.wizard-card form').valid();
        	if(!$valid) {
        		$validator.focusInvalid();
        		return false;
        	}else{
				e.preventDefault();
				studentChecker = validateStudent();
				if (studentChecker == 1) 
				{
					
					WPP.embeddedPayUrl(
						<?php
						echo '"' . $_SESSION['payment-redirect-url'] . '"';
						?>
					);
				}
				else
				{
					return false;
				}
				
			}
			/*
            WPP.embeddedPayUrl(
                <?php
                echo '"' . $_SESSION['payment-redirect-url'] . '"';
                ?>
			);
			*/
        });
    });

	
</script>


