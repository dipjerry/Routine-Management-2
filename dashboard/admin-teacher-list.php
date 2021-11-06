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
					<h5 class="page-title"><i class="fa fa-user-secret"></i>ALL TEACHER</h5>
					<div class="section-divider"></div>
				</div>
			</div>
			<span id="message"></span>
			<div class="row">
				<div class="col-lg-12 clear-padding-xs">
					<div class="col-lg-12">
						<div class="dash-item first-dash-item">
							<h6 class="item-title"><i class="fa fa-user"></i>TEACHERS</h6>
							<div class="inner-item">
								<table class="table table-bordered" id="category_table" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>Teacher code</th>
											<th>Name</th>
											<th>Gender</th>
											<th>Phone</th>
											<th>Email</th>
											<th>Subject</th>
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
						<h4 class="modal-title bill_details" id="modal_title">DELETE TEACHER</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="table-action-box">
							<h3>Are you sure you want to delete this teacher?</h3>
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
		<div id="editDetailModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-edit"></i>EDIT TEACHER DETAILS</h4>
					</div>
					<div class="modal-body dash-form">
						<div class="col-sm-3">
							<label class="clear-top-margin"><i class="fa fa-user"></i>FIRST NAME</label>
							<input type="text" placeholder="First Name" value="John" />
						</div>
						<div class="col-sm-3">
							<label class="clear-top-margin"><i class="fa fa-user"></i>MIDDLE NAME</label>
							<input type="text" placeholder="Middle Name" value="Fidler" />
						</div>
						<div class="col-sm-3">
							<label class="clear-top-margin"><i class="fa fa-user"></i>LAST NAME</label>
							<input type="text" placeholder="Last Name" value="Doe" />
						</div>
						<div class="col-sm-3">
							<label class="clear-top-margin"><i class="fa fa-book"></i>CLASS</label>
							<input type="text" placeholder="Standard" value="5 STD" />
						</div>
						<div class="clearfix"></div>
						<div class="col-sm-3">
							<label><i class="fa fa-cogs"></i>SECTION</label>
							<input type="text" placeholder="Section" value="PTH05A" />
						</div>
						<div class="col-sm-3">
							<label><i class="fa fa-puzzle-piece"></i>ROLL #</label>
							<input type="text" placeholder="Roll Number" value="Fidler" />
						</div>
						<div class="col-sm-3">
							<label><i class="fa fa-phone"></i>CONTACT #</label>
							<input type="text" placeholder="Contact Number" value="1234567890" />
						</div>
						<div class="col-sm-3">
							<label><i class="fa fa-envelope-o"></i>EMAIL</label>
							<input type="text" placeholder="Email" value="john@gmail.com" />
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
				url: "./controller/teacher_action.php",
				type: "POST",
				data: {
					action: 'fetch'
				}
			},
			"columnDefs": [{
				"targets": [6],
				"orderable": true,
			}, ],
		});
		$(document).on('click', '.delete_button', function() {
			var id = $(this).data('id');
			$('#delete_hidden_id').val(id);
			$('#deleteDetailModal').modal('show');
		});
		$(document).on('click', '#delete', function() {
			var id = $('#delete_hidden_id').val();
			$.ajax({
				url: "./controller/teacher_action.php",
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