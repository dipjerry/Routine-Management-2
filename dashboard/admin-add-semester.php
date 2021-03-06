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
					<h5 class="page-title"><i class="fa fa-cogs"></i>ALLOT CLASSROOM</h5>
					<div class="section-divider"></div>
				</div>
			</div>
			<span id="message"></span>
			<span id="form_message"></span>
			<div class="row">
				<div class="col-lg-12 clear-padding-xs">
					<div class="col-sm-4 side">
						<div class="dash-item first-dash-item">
							<h6 class="item-title"><i class="fa fa-plus-circle"></i>ADD CLASSROOM</h6>
							<div class="inner-item">
								<div class="dash-form">
									<form action="post" id="AllotRoomForm">
										<label class="clear-top-margin"><i class="fa fa-book"></i>COURSE</label>
										<?php echo $object->get_course() ?>
										<label><i class="fa fa-book"></i>BRANCH</label>
										<div id="branch_container">
											<select name="branch" id="branch_select" disabled required>
												<option value="" readonly>Select branch</option>
											</select>
										</div>
										<label><i class="fa fa-book"></i>SEMESTER</label>
										<div id="semester_container">
											<select name="branch" id="branch_select" disabled required>
												<option value="" readonly>Select semester</option>
											</select>
										</div>
										<!-- <input type="text" placeholder="A" /> -->
										<label class="clear-top-margin"><i class="fa fa-book"></i>CLASSROOM</label>
										<?php echo $object->get_free_classroom() ?>
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
							<h6 class="item-title"><i class="fa fa-sliders"></i>ALL CLASSROOM</h6>
							<div class="inner-item">
								<table id="classroomDetailedTable" class="display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th><i class="fa fa-book"></i>COURSE</th>
											<th><i class="fa fa-cogs"></i>BRANCH</th>
											<th><i class="fa fa-code"></i>SEMESTER</th>
											<th><i class="fa fa-info-circle"></i>CLASSROOM</th>
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
						<h4 class="modal-title bill_details" id="modal_title">DELETE SEMESTER</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="table-action-box">
							<h3>Are you sure you want to delete this semester?</h3>
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
						<h4 class="modal-title"><i class="fa fa-edit"></i>EDIT SECTION DETAILS</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<form method="post" id="edit_allotment_form">
						<div class="modal-body dash-form">
							<div class="col-sm-12">
								<label class="clear-top-margin"><i class="fa fa-book"></i>COURSE</label>
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
							<div class="col-sm-12">
								<label><i class="fa fa-book"></i>CLASSROOM</label>
								<?php echo $object->get_free_classroom_edit() ?>
							</div>

							<div class="clearfix"></div>
						</div>
						<div class="modal-footer">
							<div class="table-action-box">
								<input type="hidden" name="id" id="id">
								<input type="hidden" name="form_hidden_id" id="form_hidden_id">
								<input type="hidden" name="action" id="edit" value="edit">
								<button type="submit" class="btn btn-success" id="teacher_edit_course"><i class=" fa fa-check"></i> &nbsp;Okay &nbsp;</button>
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
		var dataTable = $('#classroomDetailedTable').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "./controller/allot_classroom_action.php",
				type: "POST",
				data: {
					action: 'fetch'
				}
			},
			"columnDefs": [{
				"targets": [3],
				"orderable": true,
			}, ],
		});
		$('#AllotRoomForm').on('submit', function(event) {
			event.preventDefault();
			if ($('#AllotRoomForm').parsley().isValid()) {
				$.ajax({
					url: "./controller/allot_classroom_action.php",
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
							setTimeout(function() {
								$('#form_message').html('');
							}, 5000);
							$('#AllotRoomForm').trigger('reset');
							$('#submit_button').val('Add');
						} else {
							$('#AllotRoomForm').trigger('reset');
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
				url: "./controller/allot_classroom_action.php",
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
		$('#edit_allotment_form').on('submit', function(event) {
			event.preventDefault();

			if ($('#edit_allotment_form').parsley().isValid()) {
				$.ajax({
					url: "./controller/allot_classroom_action.php",
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
							$('#edit_allotment_form').trigger("reset");
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
				url: "./controller/allot_classroom_action.php",
				method: "POST",
				data: {
					id: id,
					action: 'fetch_single'
				},
				dataType: 'JSON',
				success: function(data) {
					dropbox(data.course_code, 'edit')

					setTimeout(function() {
						$('#course_select_edit').val(data.course_code);
						$('#id').val(data.id);
						$('#branch_select').val(data.branch);
						$('#semester_list').val(data.semester);
						$('#classroom_select_edit').val(data.classroom);
						$('#editDetailModal').modal('show');
					}, 100);
				}
			})
		});
	});
</script>