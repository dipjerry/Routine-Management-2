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
					<h5 class="page-title"><i class="fa fa-cogs"></i>ALL SECTIONS</h5>
					<div class="section-divider"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 clear-padding-xs">
					<div class="col-sm-4">
						<div class="dash-item first-dash-item">
							<h6 class="item-title"><i class="fa fa-plus-circle"></i>ADD SECTION</h6>
							<div class="inner-item">
								<div class="dash-form">
									<label class="clear-top-margin"><i class="fa fa-book"></i>SECTION</label>
									<input type="text" placeholder="A" />
									<label><i class="fa fa-code"></i>SECTION CLASS</label>
									<select>
										<option>-- Select --</option>
										<option>STD 5</option>
										<option>STD 6</option>
									</select>
									<label><i class="fa fa-user-secret"></i>SECTION CODE</label>
									<input type="text" placeholder="PTH05A" />
									<label><i class="fa fa-info-circle"></i>DESCRIPTION</label>
									<textarea placeholder="Enter Description Here"></textarea>
									<div>
										<a href="#"><i class="fa fa-paper-plane"></i> CREATE</a>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="dash-item first-dash-item">
							<h6 class="item-title"><i class="fa fa-sliders"></i>ALL SECTIONS</h6>
							<div class="inner-item">
								<table id="attendenceDetailedTable" class="display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th><i class="fa fa-book"></i>CLASS</th>
											<th><i class="fa fa-cogs"></i>SECTION</th>
											<th><i class="fa fa-code"></i>SECTION CODE</th>
											<th><i class="fa fa-info-circle"></i>DESCRIPTION</th>
											<th><i class="fa fa-sliders"></i>ACTION</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>5 STD</td>
											<td>A</td>
											<td>PTH05A</td>
											<td>Section Desc</td>
											<td class="action-link">
												<a class="edit" href="#" title="Edit" data-toggle="modal" data-target="#editDetailModal"><i class="fa fa-edit"></i></a>
												<a class="delete" href="#" title="Delete" data-toggle="modal" data-target="#deleteDetailModal"><i class="fa fa-remove"></i></a>
											</td>
										</tr>
										<tr>
											<td>5 STD</td>
											<td>B</td>
											<td>PTH05B</td>
											<td>Description</td>
											<td class="action-link">
												<a class="edit" href="#" title="Edit" data-toggle="modal" data-target="#editDetailModal"><i class="fa fa-edit"></i></a>
												<a class="delete" href="#" title="Delete" data-toggle="modal" data-target="#deleteDetailModal"><i class="fa fa-remove"></i></a>
											</td>
										</tr>
										<tr>
											<td>4 STD</td>
											<td>A</td>
											<td>PTH04A</td>
											<td>Section Desc</td>
											<td class="action-link">
												<a class="edit" href="#" title="Edit" data-toggle="modal" data-target="#editDetailModal"><i class="fa fa-edit"></i></a>
												<a class="delete" href="#" title="Delete" data-toggle="modal" data-target="#deleteDetailModal"><i class="fa fa-remove"></i></a>
											</td>
										</tr>
										<tr>
											<td>4 STD</td>
											<td>B</td>
											<td>PTH04B</td>
											<td>Description</td>
											<td class="action-link">
												<a class="edit" href="#" title="Edit" data-toggle="modal" data-target="#editDetailModal"><i class="fa fa-edit"></i></a>
												<a class="delete" href="#" title="Delete" data-toggle="modal" data-target="#deleteDetailModal"><i class="fa fa-remove"></i></a>
											</td>
										</tr>
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
						<h4 class="modal-title"><i class="fa fa-trash"></i>DELETE SECTION</h4>
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
						<h4 class="modal-title"><i class="fa fa-edit"></i>EDIT SECTION DETAILS</h4>
					</div>
					<div class="modal-body dash-form">
						<div class="col-sm-4">
							<label class="clear-top-margin"><i class="fa fa-book"></i>SECTION</label>
							<input type="text" placeholder="SECTION" value="A" />
						</div>
						<div class="col-sm-4">
							<label class="clear-top-margin"><i class="fa fa-code"></i>SECTION CODE</label>
							<input type="text" placeholder="SECTION CODE" value="PTH05A" />
						</div>
						<div class="col-sm-4">
							<label class="clear-top-margin"><i class="fa fa-user-secret"></i>SECTION CLASS</label>
							<select>
								<option>-- Select --</option>
								<option>5 STD</option>
								<option>6 STD</option>
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