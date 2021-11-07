<?php include('includes/header.php') ?>


<div class="parent-wrapper" id="outer-wrapper">
	<!-- SIDE MENU -->
	<?php include('includes/sidemenu.php') ?>

	<!-- MAIN CONTENT -->
	<div class="main-content" id="content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 clear-padding-xs">
					<h5 class="page-title"><i class="fa fa-clock-o"></i>CREATE TIMETABLE</h5>
					<div class="section-divider"></div>
				</div>
			</div>
			<span id="message"></span>
			<span id="form_message"></span>
			<div class="row">
				<div class="col-lg-12 clear-padding-xs">
					<div class="col-sm-12">
						<form action="" method="post" id="timetableForm">
							<div class="dash-item first-dash-item">
								<h6 class="item-title"><i class="fa fa-plus-circle"></i>SELECT COURSE</h6>
								<div class="inner-item">
									<div class="dash-form">
										<div class="col-sm-3">
											<label><i class="fa fa-book"></i>COURSE</label>
											<?php echo $object->get_course() ?>
										</div>
										<div class="col-sm-3">
											<label><i class="fa fa-book"></i>BRANCH</label>
											<div id="branch_container">
												<select name="branch" id="branch_select" disabled required>
													<option value="" readonly>Select branch</option>
												</select>
											</div>
										</div>
										<div class="col-sm-3">
											<label><i class="fa fa-book"></i>SEMESTER</label>
											<div id="semester_container">
												<select name="branch" id="branch_select" disabled required>
													<option value="" readonly>Select semester</option>
												</select>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="dash-item">
								<h6 class="item-title"><i class="fa fa-plus-circle"></i>SLOT SELECT</h6>
								<div class="inner-item">
									<div class="dash-form">
										<div class="col-sm-3">
											<label><i class="fa fa-calendar"></i>DAY</label>
											<?php echo $object->days() ?>
										</div>
										<div class="col-sm-3">
											<label><i class="fa fa-code"></i>SUBJECT</label>
											<?php echo $object->no_timetable_subject() ?>
										</div>
										<div class="col-sm-3">
											<label><i class="fa fa-user"></i>TEACHER</label>
											<div id="teacher_container">
												<select name="teacher" id="teacher_select" disabled required>
													<option value="" readonly>Select Teacher</option>
												</select>
											</div>

										</div>

										<div class="col-sm-3">
											<label><i class="fa fa-clock-o"></i>SLOT</label>
											<div id="slot_container">
												<select name="slot" id="slot_select" disabled required>
													<option value="" readonly>Select Slot</option>
												</select>
											</div>
										</div>

										<div class="clearfix"></div>
										<div class="col-sm-12">
											<input type="hidden" name="action" value="Add" />
											<button type="submit" id="register_button" class="btn btn-success btn-user p-3 m-3"><i class="fa fa-paper-plane"></i>Save</button>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="clearfix"></div>
							</div>
						</form>
					</div>
					<div class="col-sm-12">
						<div class="dash-item">
							<h6 class="item-title"><i class="fa fa-sliders"></i>ALL SLOTS</h6>
							<div class="inner-item">
								<table id="routineTable" class="display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th><i class="fa fa-clock-o"></i>WEEKENDS</th>
											<th><i class="fa fa-calendar"></i>SUBJECT</th>
											<th><i class="fa fa-calendar"></i>PERIOD</th>
											<th><i class="fa fa-calendar"></i>STATUS</th>
											<th><i class="fa fa-calendar"></i>ACTION</th>

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
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title bill_details" id="modal_title">DELETE S</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="table-action-box">
							<h3>Are you sure you want to delete this slot?</h3>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="table_name" id="table_name">
						<input type="hidden" name="teacher" id="teacher">
						<input type="hidden" name="period" id="period">
						<input type="hidden" name="day" id="day">
						<input type="hidden" name="class" id="class">
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
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-edit"></i>EDIT SECTION DETAILS</h4>
					</div>
					<form method="post" id="edit_routine_form">
						<div class="modal-body dash-form">
							<div class="col-sm-12">
								<div class="col-sm-3">
									<label><i class="fa fa-code"></i>SUBJECT</label>
									<?php echo $object->no_timetable_subject() ?>
								</div>
							</div>
							<div class="col-sm-12">
								<label><i class="fa fa-user"></i>TEACHER</label>
								<div id="teacher_container">
									<select name="teacher" id="teacher_select" disabled required>
										<option value="" readonly>Select Teacher</option>
									</select>
								</div>
							</div>

							<div class="clearfix"></div>
						</div>
						<div class="modal-footer">
							<div>
								<input type="hidden" name="action" value="Add" />
								<button type="submit" id="register_button" class="btn btn-success btn-user p-3 m-3">
									<i class="fa fa-paper-plane"></i>Save
								</button>
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
		var dataTable = $('#routineTable').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "./controller/timetable_action.php",
				type: "POST",
				data: {
					action: 'fetch'
				}
			},
			"columnDefs": [{
				"targets": [4],
				"orderable": true,
			}, ],
		});
		$('#timetableForm').on('submit', function(event) {
			event.preventDefault();
			if ($('#timetableForm').parsley().isValid()) {
				$.ajax({
					url: "./controller/timetable_action.php",
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
							dataTable.ajax.reload();
							setTimeout(function() {
								$('#message').html('');
							}, 5000);
						}
					}
				})
			}
		});

		slot = `<select name="slot" id="slot_select" disabled required> 
			<option value = "" readonly > Select Slot <select /option> 
			</select>`

		function dropbox(course, state) {
			$.ajax({
				url: "./controller/timetable_action.php",
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
		$(document).on('change', '#no_timetable_subject', function() {
			let subject = $(this).val();
			$.ajax({
				url: "./controller/custom.php",
				data: {
					subject: subject,
					action: 'subjectTeacher'
				},
				type: 'POST',
				success: function(response) {
					const dropDown = JSON.parse(response);
					$("#teacher_container").html(dropDown.teacher);

				}
			});
		});

		function slotChange() {
			const teacher = $('#teacher_select').val();
			const days = $('#day_list').val();
			const course = $('#course_select').val();
			const branch = $('#branch_select').val();
			const semester = $('#semester_list').val();
			$.ajax({
				url: "./controller/custom.php",
				data: {
					day: days,
					teacher: teacher,
					course: course,
					branch: branch,
					semester: semester,
					action: 'freeSlot'
				},
				type: 'POST',
				success: function(response) {

					const dropDown = JSON.parse(response);
					if (dropDown.error != '') {
						$('#form_message').html(dropDown.error);
						setTimeout(function() {
							$('#form_message').html('');
						}, 5000);

					} else {
						$("#slot_container").html(dropDown.slot);
					}



				}
			});
		}

		$(document).on('change', '#teacher_select', function() {
			const teacher = $(this).val();
			const days = $('#day_list').val();
			const course = $('#course_select').val();
			const branch = $('#branch_select').val();
			const semester = $('#semester_list').val();
			if (course == '') {
				$('#form_message').html('Select Course');
				$('#course_select').focus();
				return;
			};
			if (branch == '') {
				$('#form_message').html('Select Branch');
				$('#branch_select').focus();
				return;
			}
			if (semester == '') {
				$('#form_message').html('Select semester  ');
				$('#semester_list').focus();
				return;
			}
			if (days == '') {
				$('#form_message').html('Select semester  ');
				$('#day_list').focus();
				return;
			}
			slotChange();
		});

		$(document).on('click', '.delete_button', function() {
			var id = $(this).data('id');
			var day = $(this).data('day');
			var teacher = $(this).data('teacher');
			var table_name = $(this).data('table_name');
			var period = $(this).data('period');
			var class_name = $(this).data('class');
			$('#delete_hidden_id').val(id);
			$('#day').val(day);
			$('#class').val(class_name);
			$('#period').val(period);
			$('#deleteDetailModal').modal('show');
		});
		$(document).on('click', '#delete', function() {
			var id = $('#delete_hidden_id').val();
			var day = $('#day').val();
			var period = $('#period').val();
			var class_name = $('#class').val();
			var teacher = $('#teacher').val();
			var table_name = $('#table_name').val();
			$.ajax({
				url: "./controller/timetable_action.php",
				method: "POST",
				data: {
					period: period,
					day: day,
					id: id,
					class_name: class_name,
					table_name: table_name,
					teacher: teacher,
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