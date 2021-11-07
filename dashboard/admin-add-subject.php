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
					<div class="col-sm-4 side">
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
											<select name="branch" disabled required>
												<option value="" readonly>Select semester</option>VP
											</select>
										</div>
										<label><i class="fa fa-book"></i>BRANCH</label>
										<div id="branch_container">
											<select name="branch" disabled required>
												<option value="" readonly>Select branch</option>
											</select>
										</div>
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
		<div id="deleteDetailModal" style="z-index:9999 !important;" class="modal">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title bill_details" id="modal_title">DELETE SUBJECT</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="table-action-box">
							<h3>Are you sure you want to delete this subject?</h3>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="delete_hidden_id" id="delete_hidden_id">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-success" id="delete" data-dismiss="modal"> &nbsp;Okay &nbsp;</button>
					</div>
				</div>
			</div>
		</div>

		<!--Edit details modal-->




		<div id="editDetailModal" style="z-index:9999 !important;" class="modal">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-edit"></i>EDIT SUBJECT DETAILS</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<form method="post" id="edit_subject_form">
						<div class="modal-body dash-form">
							<div class="col-sm-12">
								<label class="clear-top-margin"><i class="fa fa-book"></i>SUBJECT</label>
								<input type="text" name="subject" id="subject" placeholder="Basic Mathematics" />
							</div>
							<div class="col-sm-12">
								<label><i class="fa fa-book"></i>COURSE</label>
								<?php echo $object->get_course_edit() ?>
							</div>
							<div class="col-sm-12">
								<label><i class="fa fa-user-secret"></i>BRANCH</label>
								<div id="branch_container_edit">
									<select name="branch" id="branch_select_edit" disabled required>
										<option value="" readonly>Select branch</option>
									</select>
								</div>
							</div>
							<div class="col-sm-12">
								<label><i class="fa fa-user-secret"></i>SEMESTER</label>
								<div id="semester_container_edit">
									<select name="semester" id="semester_select_edit" disabled required>
										<option value="" reado nly>Select semester</option>
									</select>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-sm-12">
								<label><i class="fa fa-info-circle"></i>DESCRIPTION</label>
								<textarea id='description' name='description' placeholder="Enter Description Here"></textarea>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="modal-footer">
							<div class="table-action-box">
								<input type="hidden" name="id" id="id">
								<input type="hidden" name="form_hidden_id" id="form_hidden_id">
								<input type="hidden" name="action" id="edit" value="edit">
								<button type="submit" class="btn btn-success" id="teacher_edit_submit"><i class=" fa fa-check"></i> &nbsp;Okay &nbsp;</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i>&nbsp;Cancel</button>
							</div>
						</div>
					</form>
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

		$('#edit_subject_form').on('submit', function(event) {
			event.preventDefault();
			// form = new FormData(this);

			// for (var pair of form.entries()) {
			// 	console.log(pair[0] + ', ' + pair[1]);
			// }
			if ($('#edit_subject_form').parsley().isValid()) {
				$.ajax({
					url: "./controller/subject_action.php",
					method: "POST",
					data: new FormData(this),
					dataType: 'json',
					contentType: false,
					processData: false,
					success: function(data) {
						$('#submit_button').attr('disabled', false);
						// alert("data");
						if (data.error != '') {
							$('#form_message').html(data.error);
						} else {
							$('#editDetailModal').modal('hide');
							$('#edit_subject_form').trigger("reset");
							$('#message').html(data.success);
							dataTable.ajax.reload();
							setTimeout(function() {
								$('#message').html('');
							}, 5000);
						}
					}
				})
			}
		});

		$(document).on('click', '.edit_button', function() {
			var id = $(this).data('id');
			$.ajax({
				url: "./controller/subject_action.php",
				method: "POST",
				data: {
					id: id,
					action: 'fetch_single'
				},
				dataType: 'JSON',
				success: function(data) {
					dropbox(data.course, 'edit')
					setTimeout(function() {
						$('#subject').val(data.name);
						$('#alias').val(data.alias);
						$('#id').val(data.id);
						$('#form_hidden_id').val(data.subject_code);
						$('#course_select_edit').val(data.course);
						$('#semester_list').val(data.semester);
						$('#branch_select').val(data.branch);
						$('#description').val('description');
						$('#editDetailModal').modal('show');
					}, 500);


				}
			})
		});

		function dropbox(course, state) {
			$.ajax({
				url: "./controller/allot_classroom_action.php",
				data: {
					course: course,
					action: 'dropDownFill'
				},
				type: 'POST',
				success: function(response) {
					const dropDown = JSON.parse(response);
					if (state == 'add') {
						$("#semester_container").html(dropDown.semester);
						$("#branch_container").html(dropDown.branch);
					}
					if (state == 'edit') {
						$("#semester_container_edit").html(dropDown.semester);
						$("#branch_container_edit").html(dropDown.branch);
					}

				}
			});
		}

		$(document).on('change', '#course_select', function() {
			const course = $(this).val();
			dropbox(course, 'add')

		});
		$(document).on('click', '.delete_button', function() {
			var id = $(this).data('id');
			$('#delete_hidden_id').val(id);
			$('#deleteDetailModal').modal('show');
		});
		$(document).on('click', '#delete', function() {
			var id = $('#delete_hidden_id').val();
			$.ajax({
				url: "./controller/subject_action.php",
				method: "POST",
				data: {
					id: id,
					action: 'delete'
				},
				success: function(data) {
					$('#message').html(data);
					dataTable.ajax.reload();
					setTimeout(function() {
						$('#message').html('');
					}, 5000);
				}
			})

		});
	});
</script>