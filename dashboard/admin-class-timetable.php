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
					<h5 class="page-title"><i class="fa fa-users"></i>CLASS TIMETABLE</h5>
					<div class="section-divider"></div>
				</div>
			</div>
			<span id="message"></span>
			<div class="row">
				<div class="col-lg-12 clear-padding-xs">
					<div class="col-lg-12">
						<div class="dash-item first-dash-item">
							<h6 class="item-title"><i class="fa fa-search"></i>MAKE SELECTION</h6>
							<div class="inner-item dash-search-form">
								<div class="dash-form">
									<!-- <form action="" method="post" id="timetablePreview"> -->
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
									<div class="col-sm-4">
										<input type="hidden" name="action" value="display">
										<button type="button" class="submit-btn" id="preview-btn"><i class="fa fa-search"></i>SHOW</button>
									</div>
									<!-- </form> -->
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="dash-item">
							<h6 class="item-title"><i class="fa fa-edit"></i>EDIT TIMETABLE</h6>
							<div class="inner-item">
								<!-- <table id="attendenceDetailedTable" class="display responsive nowrap" cellspacing="0" width="100%"> -->
								<table id="routineTable" class="display responsive nowrap table table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th><i class="fa fa-clock-o"></i>WEEKENDS</th>
											<th><i class="fa fa-calendar"></i>PERIOD 1</th>
											<th><i class="fa fa-calendar"></i>PERIOD 2</th>
											<th><i class="fa fa-calendar"></i>PERIOD 3</th>
											<th><i class="fa fa-calendar"></i>PERIOD 4</th>
											<th><i class="fa fa-calendar"></i>PERIOD 5</th>
											<th><i class="fa fa-calendar"></i>BREAK</th>
											<th><i class="fa fa-calendar"></i>PERIOD 6</th>

										</tr>
									</thead>
									<tbody id="getRoutine" class="table-striped ">

									</tbody>
								</table>
								<div class="table-action-box">
									<a href="#" class="save"><i class="fa fa-check"></i>SAVE</a>
									<a href="#" class="cancel"><i class="fa fa-ban"></i>CANCEL</a>
								</div>
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
	</div>
</div>

<!-- Delete Modal -->
<div id="deleteDetailModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class="fa fa-trash"></i>DELETE SLOT</h4>
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
				<h4 class="modal-title"><i class="fa fa-edit"></i>EDIT SLOT DETAILS</h4>
			</div>
			<div class="modal-body dash-form">
				<div class="col-sm-3">
					<label class="clear-top-margin"><i class="fa fa-clock-o"></i>SLOT</label>
					<select>
						<option>09 - 10 AM </option>
						<option>09 - 10 AM </option>
						<option>10 - 11 AM </option>
						<option>11 - 12 PM </option>
					</select>
				</div>
				<div class="col-sm-3">
					<label class="clear-top-margin"><i class="fa fa-calendar"></i>MONDAY</label>
					<select>
						<option>MTH101 </option>
						<option>PHY101</option>
						<option>BIO101</option>
						<option>CHE101</option>
					</select>
				</div>
				<div class="col-sm-3">
					<label class="clear-top-margin"><i class="fa fa-calendar"></i>TUESDAY</label>
					<select>
						<option>MTH101 </option>
						<option>PHY101</option>
						<option>BIO101</option>
						<option>CHE101</option>
					</select>
				</div>
				<div class="col-sm-3">
					<label class="clear-top-margin"><i class="fa fa-calendar"></i>WEDNESDAY</label>
					<select>
						<option>MTH101 </option>
						<option>PHY101</option>
						<option>BIO101</option>
						<option>CHE101</option>
					</select>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-3">
					<label><i class="fa fa-calendar"></i>THURSDAY</label>
					<select>
						<option>MTH101 </option>
						<option>PHY101</option>
						<option>BIO101</option>
						<option>CHE101</option>
					</select>
				</div>
				<div class="col-sm-3">
					<label><i class="fa fa-calendar"></i>FRIDAY</label>
					<select>
						<option>MTH101 </option>
						<option>PHY101</option>
						<option>BIO101</option>
						<option>CHE101</option>
					</select>
				</div>
				<div class="col-sm-3">
					<label><i class="fa fa-calendar"></i>SATURDAY</label>
					<select>
						<option>MTH101 </option>
						<option>PHY101</option>
						<option>BIO101</option>
						<option>CHE101</option>
					</select>
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
<?php include('includes/footer.php') ?>

<script>
	$(document).ready(function() {
		$('#attendenceDetailedTable').dataTable({
			"ordering": false
		});

		function onload_display() {
			$.ajax({
				url: "./controller/preview_timetable_action.php",
				type: "POST",
				data: {
					action: 'display_on_load'
				},
				type: 'POST',
				success: function(data) {
					$('#getRoutine').html(data);
				}
			})
		}
		onload_display();
		$('#preview-btn').on('click', function(event) {
			const course = $('#course_select').val();
			const branch = $('#branch_select').val();
			const semester = $('#semester_list').val();
			$.ajax({
				url: "./controller/preview_timetable_action.php",
				type: "POST",
				data: {
					course: course,
					branch: branch,
					semester: semester,
					action: 'display'
				},
				type: 'POST',
				success: function(data) {
					$('#getRoutine').html(data);
				}
			})

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
		$(document).on('click', '.delete_button', function() {
			const id = $(this).data('id');
			$('#delete_hidden_id').val(id);
			$('#deleteDetailModal').modal('show');
		});

		$(document).on('click', '.cancel_class', function() {
			const day = $(this).data('day');
			const period = $(this).data('period');
			const status = $(this).data('status');
			let action = '';
			let message = '';
			let state = '';
			if (status == 'cancelled') {
				action = 'active';
				message = 'Active class'
				state = 'Active'
			} else {
				action = "cancel";
				message = 'Confirm cancel class again?'
				state = 'cancelled'
			}
			$.confirm({
				title: 'Confirm!',
				content: message,
				buttons: {
					confirm: function() {
						$.ajax({
							url: "./controller/timetable_action.php",
							data: {
								period: period,
								day: day,
								action: action
							},
							type: 'POST',
							success: function(response) {
								onload_display();
								$.alert(state);
							}
						});
					},
					cancel: function() {
						// $.alert('Canceled!');
					},

				}
			});

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
	});
</script>