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
					<h5 class="page-title"><i class="fa fa-bullhorn"></i>ALL ANNOUNCEMENTS</h5>
					<div class="section-divider"></div>
				</div>
			</div>
			<span id="message"></span>
			<div class="row">
				<div class="col-lg-12 clear-padding-xs">
					<div class="col-sm-4 side">
						<div class="dash-item first-dash-item">
							<h6 class="item-title"><i class="fa fa-plus-circle"></i>ADD ANNOUNCEMENT</h6>
							<div class="inner-item">
								<div class="dash-form">
									<form method="post" id="announcementForm" enctype="multipart/form-data">
										<label><i class="fa fa-code"></i>SUBJECT</label>
										<input type="text" placeholder="Subject" name="subject" />
										<label><i class="fa fa-info-circle"></i>MESSAGE</label>
										<textarea placeholder="Enter Description Here" name="message"></textarea>
										<label><i class="fa fa-link"></i>LINK</label>
										<input type="text" placeholder="Enter Link Here" name="link">
										<label><i class="fa fa-link"></i>Image</label>
										<input type="file" name="image">
										<div>
											<input type="hidden" name="action" value="Add" />

											<button type="submit" id="register_button" class="btn btn-success btn-user p-3 m-3"><i class="fa fa-paper-plane"></i>Save</button>

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
							<h6 class="item-title"><i class="fa fa-bullhorn"></i>ALL ANNOUNCEMENTS</h6>
							<div class="inner-item">

								<table class="table table-bordered" id="category_table" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>Subject</th>
											<th>Message</th>
											<th>Link</th>
											<th>Display Image</th>
											<th>Action</th>
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
						<h4 class="modal-title bill_details" id="modal_title">DELETE ANNOUNCEMENT</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="table-action-box">
							<h3>Are you sure you want to delete this announcement?</h3>
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
						<h4 class="modal-title"><i class="fa fa-edit"></i>EDIT CLASS DETAILS</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<form id="accouncement_edit_form">
						<div class="modal-body dash-form">
							<div class="col-sm-12">
								<label><i class="fa fa-code"></i>SUBJECT</label>
								<input type="text" placeholder="Subject" name="subject" id="subject" />
							</div>
							<div class="col-sm-12">
								<label><i class="fa fa-info-circle"></i>MESSAGE</label>
								<textarea name="message" id="message_text"></textarea>
							</div>
							<div class="col-sm-12">
								<label><i class="fa fa-link"></i>LINK</label>
								<input type="text" placeholder="Enter Link Here" name="link" id="link">
							</div>
							<div class="clearfix"></div>
							<div class="col-sm-12">
								<label><i class="fa fa-link"></i>Image</label>
								<input type="file" name="image">
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="modal-footer">
							<div class="table-action-box">
								<input type="hidden" name="id" id="id">
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
		var dataTable = $('#category_table').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "./controller/announcement_action.php",
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

		$('#announcementForm').on('submit', function(event) {
			event.preventDefault();
			if ($('#announcementForm').parsley().isValid()) {
				$.ajax({
					url: "./controller/announcement_action.php",
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
							$('#announcementForm').trigger("reset");
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
		$('#accouncement_edit_form').on('submit', function(event) {
			event.preventDefault();
			form = new FormData(this);
			// for (var pair of form.entries()) {
			// 	console.log(pair[0] + ', ' + pair[1]);
			// }
			if ($('#accouncement_edit_form').parsley().isValid()) {
				$.ajax({
					url: "./controller/announcement_action.php",
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
							$('#accouncement_edit_form').trigger("reset");
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
				url: "./controller/announcement_action.php",
				method: "POST",
				data: {
					id: id,
					action: 'fetch_single'
				},
				dataType: 'JSON',
				success: function(data) {
					$('#id').val(data.id);
					$('#subject').val(data.subject);
					$('#message_text').val(data.message);
					$('#link').val(data.link);

					$('#editDetailModal').modal('show');
				}
			})
		});
		$(document).on('click', '.delete_button', function() {
			var id = $(this).data('id');
			$('#delete_hidden_id').val(id);
			$('#deleteDetailModal').modal('show');
		});
		$(document).on('click', '#delete', function() {
			var id = $('#delete_hidden_id').val();
			$.ajax({
				url: "./controller/announcement_action.php",
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