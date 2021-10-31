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
			<div class="row">
				<div class="col-lg-12 clear-padding-xs">
					<div class="col-sm-4">
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
		<div id="deleteDetailModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-trash"></i>DELETE CLASS</h4>
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
						<h4 class="modal-title"><i class="fa fa-edit"></i>EDIT CLASS DETAILS</h4>
					</div>
					<div class="modal-body dash-form">
						<div class="col-sm-4">
							<label class="clear-top-margin"><i class="fa fa-book"></i>CLASS</label>
							<input type="text" placeholder="CLASS" value="5 STD" />
						</div>
						<div class="col-sm-4">
							<label class="clear-top-margin"><i class="fa fa-code"></i>CLASS CODE</label>
							<input type="text" placeholder="CLASS CODE" value="PTH05" />
						</div>
						<div class="col-sm-4">
							<label class="clear-top-margin"><i class="fa fa-user-secret"></i>CLASS TEACHER</label>
							<select>
								<option>-- Select --</option>
								<option>Lennore Doe</option>
								<option>John Doe</option>
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
	});
</script>