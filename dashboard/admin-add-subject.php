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
					<h5 class="page-title"><i class="fa fa-cogs"></i>ALL SUBJECTS</h5>
					<div class="section-divider"></div>
				</div>
			</div>
			<span id="message"></span>
			<div class="row">
				<div class="col-lg-12 clear-padding-xs">
					<div class="col-sm-4">
						<div class="dash-item first-dash-item">
							<h6 class="item-title"><i class="fa fa-plus-circle"></i>ADD SUBJECT</h6>
							<div class="inner-item">
								<div class="dash-form">
									<form action="post" id="subjectForm">
										<label class="clear-top-margin"><i class="fa fa-book"></i>NAME</label>
										<input type="text" name="subject" placeholder="Basic Mathematics" />
										<label><i class="fa fa-code"></i>SUBJECT CODE</label>
										<input type="text" name="subject_code" placeholder="MTH101" />
										<label><i class="fa fa-book"></i>COURSE</label>
										<?php echo $object->get_course() ?>
										<label><i class="fa fa-book"></i>SEMESTER</label>
										<div id="semester_container">
											<select name="branch" id="branch_select" disabled required>
												<option value="" readonly>Select semester</option>
											</select>
										</div>
										<label><i class="fa fa-book"></i>BRANCH</label>
										<div id="branch_container">
											<select name="branch" id="branch_select" disabled required>
												<option value="" readonly>Select branch</option>
											</select>
										</div>


										<label><i class="fa fa-code"></i>TEACHER</label>
										<?php echo $object->get_teacher() ?>

										<label><i class="fa fa-info-circle"></i>DESCRIPTION</label>
										<textarea name="description" placeholder="Enter Description Here"></textarea>
										<div class="col-sm-12">
											<input type="hidden" name="action" value="Add" />
											<button type="submit" id="register_button" class="btn btn-success btn-user p-3 m-3"><i class="fa fa-paper-plane"></i> Save</button>
										</div>
									</form>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="dash-item first-dash-item">
							<h6 class="item-title"><i class="fa fa-sliders"></i>ALL SUBJECTS</h6>
							<div class="inner-item">
								<table id="subjectTable" class="display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th><i class="fa fa-book"></i>NAME</th>
											<th><i class="fa fa-code"></i>CODE</th>
											<th><i class="fa fa-cogs"></i>COURSE</th>
											<th><i class="fa fa-cogs"></i>BRANCH</th>
											<th><i class="fa fa-cogs"></i>SEMESTER</th>
											<th><i class="fa fa-user-secret"></i>TEACHER</th>
											<th><i class="fa fa-info-circle"></i>DESCRIPTION</th>
											<th><i class="fa fa-sliders"></i>ACTION</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="menu-togggle-btn">
			<a href="#menu-toggle" id="menu-toggle"><i class="fa fa-bars"></i></a>
		</div>
		<div class="dash-footer col-lg-12">
			<p class="text-center">Copyright RoutineManagement</p>
		</div>

		<!-- Delete Modal -->
		<div id="deleteDetailModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-trash"></i>DELETE SUBJECT</h4>
					</div>
					<div class="modal-body">
						<div class="table-action-box">
							<a href="#" class="save"><i class="fa fa-check"></i>YES</a>
							<a href="#" class="cancel" data-dismiss="modal"><i class="fa fa-ban"></i>CLOSE</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>

		<!--Edit details modal-->
		<div id="editDetailModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-edit"></i>EDIT SUBJECT DETAILS</h4>
					</div>
					<div class="modal-body dash-form">
						<div class="col-sm-3">
							<label class="clear-top-margin"><i class="fa fa-book"></i>NAME</label>
							<input type="text" placeholder="Name" value="Mathematics" />
						</div>
						<div class="col-sm-3">
							<label class="clear-top-margin"><i class="fa fa-code"></i>CODE</label>
							<input type="text" placeholder="Code" value="MTH101" />
						</div>
						<div class="col-sm-3">
							<label class="clear-top-margin"><i class="fa fa-book"></i>CLASS</label>
							<select>
								<option>-- Select --</option>
								<option>5 STD</option>
								<option>6 STD</option>
							</select>
						</div>
						<div class="col-sm-3">
							<label class="clear-top-margin"><i class="fa fa-user-secret"></i>TEACHER</label>
							<select>
								<option>-- Select --</option>
								<option>Lennore</option>
								<option>John</option>
							</select>
						</div>
						<div class="clearfix"></div>
						<div class="col-sm-12">
							<label><i class="fa fa-info-circle"></i>DESCRIPTION</label>
							<textarea placeholder="Enter Description Here"></textarea>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="modal-footer">
						<div class="table-action-box">
							<a href="#" class="save"><i class="fa fa-check"></i>SAVE</a>
							<a href="#" class="cancel" data-dismiss="modal"><i class="fa fa-ban"></i>CLOSE</a>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<?php include('includes/footer.php') ?>
<script>
	$(document).ready(function() {
		var dataTable = $('#subjectTable').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "./controller/subject_action.php",
				type: "POST",
				data: {
					action: 'fetch'
				}
			},
			"columnDefs": [{
				"targets": [5],
				"orderable": true,
			}, ],
		});
		$('#subjectForm').on('submit', function(event) {
			event.preventDefault();
			if ($('#subjectForm').parsley().isValid()) {
				$.ajax({
					url: "./controller/subject_action.php",
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
						if (data.success != '') {
							$('#subjectForm').trigger("reset");
							$('#message').html(data.success);
							dataTable.ajax.reload();
							setTimeout(function() {
								$('#message').html('');
							}, 5000);
						} else {
							$('#form_message').html(data.error);
							$('#submit_button').val('Add');

						}
					}
				})
			}
		});
		$(document).on('change', '#course_select', function() {
			let course = $(this).val();
			$.ajax({
				url: "./controller/allot_classroom_action.php",
				data: {
					course: course,
					action: 'dropDownFill'
				},
				type: 'POST',
				success: function(response) {
					const dropDown = JSON.parse(response);
					$("#semester_container").html(dropDown.semester);
					$("#branch_container").html(dropDown.branch);
				}
			});
		});
	});
</script>