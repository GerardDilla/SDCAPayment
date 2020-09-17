
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
						<form action="<?php echo base_url(); ?>index.php/Main/payreg_ub" method="post">

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
													<input name="firstname" id="firstname-input" type="text" class="form-control">
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
													<input name="lastname" id="lastname-input" type="text" class="form-control">
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
														<input name="referencenumber" id="reference-input" type="text" class="form-control">
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
											<h4 style="text-align:center; color:#008000"></h4>
											<div class="col-sm-4">
												<div class="choice" data-toggle="wizard-checkbox">
													<input type="checkbox" class="uniqueCheckbox" name="educationtype[]" value="Basic Education">
													<div class="icon">
														<i class="fa fa-pencil"></i>
													</div>
													<h6>Basic Education</h6>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="choice" data-toggle="wizard-checkbox">
													<input type="checkbox" class="uniqueCheckbox" name="educationtype[]" value="Senior Highschool">
													<div class="icon">
														<i class="fa fa-users"></i>
													</div>
													<h6>Senior Highscool</h6>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="choice" data-toggle="wizard-checkbox">
													<input type="checkbox" class="uniqueCheckbox" name="educationtype[]" value="Higher Education">
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
											<hr>
											<div class="input-group">
											
												<span class="input-group-addon">
													<i class="material-icons">credit_card</i>
												</span>
												<div class="form-group label-floating">
												<label class="control-label">Amount to pay <small>(required)</small></label>
												<input name="amount" id="amount-input" type="number" class="form-control">

												
												
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


