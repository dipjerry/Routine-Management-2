<?php include('includes/header.php') ?>
<?php include('includes/nav.php') ?>
<div class="parent-wrapper" id="outer-wrapper">
	<!-- SIDE MENU -->
	<?php include('includes/sidemenu.php') ?>
	<!-- MAIN CONTENT -->
	<div class="main-content" id="content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 clear-padding-xs">
					<h5 class="page-title"><i class="fa fa-user-secret"></i>ADD TEACHER</h5>
					<div class="section-divider"></div>
				</div>
			</div>
			<span id="message"></span>
			<div class="row">
				<div class="col-lg-12 clear-padding-xs">
					<div class="col-md-12">
						<form method="post" id="add_teacher_form" enctype="multipart/form-data">
							<div class="dash-item first-dash-item">
								<h6 class="item-title"><i class="fa fa-user"></i>TEACHER INFO</h6>
								<div class="inner-item">
									<div class="dash-form">
										<div class="col-sm-3">
											<label class="clear-top-margin"><i class="fa fa-user-circle-o"></i>FIRST NAME</label>
											<input type="text" name="fname" placeholder="firstname" />
										</div>
										<div class="col-sm-3">
											<label class="clear-top-margin"><i class="fa fa-user-circle-o"></i>MIDDLE NAME</label>
											<input type="text" name="mname" placeholder="middlename" />
										</div>
										<div class="col-sm-3">
											<label class="clear-top-margin"><i class="fa fa-user-circle-o"></i>LAST NAME</label>
											<input type="text" name="lname" placeholder="lastname" />
										</div>
										<div class="col-sm-3">
											<label class="clear-top-margin"><i class="fa fa-user-circle-o"></i>ALIAS</label>
											<input type="text" name="alias" placeholder="alias" />
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-3">
											<label><i class="fa fa-book"></i></i>SUBJECT</label>
											<?php echo $object->no_timetable_subject() ?>
										</div>
										<div class="col-sm-3">
											<label><i class="fa fa-user-circle-o"></i>TEACHER CODE</label>
											<input type="text" name="tcode" required data-parsley-trigger="keyup" data-parsley-type="alphanum" placeholder="teacher code" />
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-3">
											<label><i class="fa fa-venus"></i>GENDER</label>
											<select name="gender">
												<option>-- Select --</option>
												<option>Male</option>
												<option>Female</option>
											</select>
										</div>
										<div class="col-sm-3">
											<label><i class="fa fa-phone"></i>PHONE </label>
											<input type="text" name="phone" placeholder="0123456789" />
										</div>
										<div class="col-sm-3">
											<label><i class="fa fa-envelope-o"></i>EMAIL</label>
											<input type="text" name="email" placeholder="xyz@email.com" />
										</div>
										<div class="col-sm-3">
											<label><i class="fa fa-file-picture-o"></i>UPLOAD PHOTO</label>
											<input type="file" name="display_image" />
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="col-sm-12">
									<input type="hidden" name="action" value="Add" />
									<button type="submit" id="register_button" class="btn btn-success btn-user p-3 m-3"><i class="fa fa-paper-plane"></i>Save</button>
								</div>
							</div>
						</form>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="menu-togggle-btn">
			<a href="#menu-toggle" id="menu-toggle"><i class="fa fa-bars"></i></a>
		</div>
		<div class="dash-footer col-lg-12">
			<p class="text-center">Copyright RoutineManagement</p>
		</div>
	</div>
</div>

<?php include('includes/footer.php') ?>
<script>
	$(document).ready(function() {
		$('#add_teacher_form').on('submit', function(event) {
			event.preventDefault();
			if ($('#add_teacher_form').parsley().isValid()) {
				$.ajax({
					url: "./controller/teacher_action.php",
					method: "POST",
					data: new FormData(this),
					dataType: 'json',
					contentType: false,
					processData: false,
					beforeSend: function() {
						$('#submit_button').attr('disabled', 'disabled');
						$('#submit_button').val('wait...');
					},
					success: function(data) {
						$('#submit_button').attr('disabled', false);
						if (data.error != '') {
							$('#form_message').html(data.error);
							$('#submit_button').val('Add');
						} else {
							$('#productModal').modal('hide');
							$('#message').html(data.success);
							// dataTable.ajax.reload();
							setTimeout(function() {
								$('#message').html('');
							}, 5000);
						}
					}
				})
			}
		});
	});
</script>