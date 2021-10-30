<?php include('includes/header.php') ?>


<div class="parent-wrapper" id="outer-wrapper">
	<!-- SIDE MENU -->
	<?php include('includes/sidemenu.php') ?>

	<!-- MAIN CONTENT -->
	<div class="main-content" id="content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 clear-padding-xs">
					<h5 class="page-title"><i class="fa fa-clock-o"></i>TIME SLOTS</h5>
					<div class="section-divider"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 clear-padding-xs">
					<div class="col-sm-12">
						<div class="dash-item first-dash-item">
							<h6 class="item-title"><i class="fa fa-plus-circle"></i>ADD SLOT</h6>
							<div class="inner-item">
								<div class="dash-form">
									<div class="col-sm-3">
										<label class="clear-top-margin"><i class="fa fa-calendar"></i>DAY</label>
										<select>
											<option>-- Select --</option>
											<option>Monday</option>
											<option>Tuesday</option>
										</select>
									</div>
									<div class="col-sm-3">
										<label class="clear-top-margin"><i class="fa fa-clock-o"></i>SLOT</label>
										<select>
											<option>-- Select --</option>
											<option>09-10 AM</option>
											<option>10-11 PM</option>
										</select>
									</div>
									<div class="col-sm-3">
										<label class="clear-top-margin"><i class="fa fa-book"></i>CLASS</label>
										<select>
											<option>-- Select --</option>
											<option>STD 5</option>
											<option>STD 6</option>
										</select>
									</div>
									<div class="col-sm-3">
										<label class="clear-top-margin"><i class="fa fa-users"></i>SECTION</label>
										<select>
											<option>-- Select --</option>
											<option>STD 5</option>
											<option>STD 6</option>
										</select>
									</div>
									<div class="col-sm-3">
										<label><i class="fa fa-code"></i>SUBJECT</label>
										<select>
											<option>-- Select --</option>
											<option>PHY101</option>
											<option>MTH101</option>
										</select>
									</div>
									<div class="col-sm-3">
										<label><i class="fa fa-user"></i>TEACHER</label>
										<select>
											<option>-- Select --</option>
											<option>John Doe</option>
											<option>Lennore Doe</option>
										</select>
									</div>
									<div class="col-sm-3">
										<label><i class="fa fa-home"></i>CLASS ROOM</label>
										<select>
											<option>-- Select --</option>
											<option>101</option>
											<option>103</option>
										</select>
									</div>
									<div class="col-sm-12">
										<a href="#"><i class="fa fa-paper-plane"></i> CREATE</a>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="dash-item">
							<h6 class="item-title"><i class="fa fa-sliders"></i>ALL SLOTS</h6>
							<div class="inner-item">
								<table id="attendenceDetailedTable" class="display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th><i class="fa fa-calendar"></i>DAY</th>
											<th><i class="fa fa-clock-o"></i>SLOT</th>
											<th><i class="fa fa-book"></i>CLASS</th>
											<th><i class="fa fa-cogs"></i>SECTION</th>
											<th><i class="fa fa-code"></i>SUBJECT</th>
											<th><i class="fa fa-user"></i>TEACHER</th>
											<th><i class="fa fa-home"></i>ROOM</th>
											<th><i class="fa fa-sliders"></i>ACTION</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Monday</td>
											<td>09-10 AM</td>
											<td>5 STD</td>
											<td>A</td>
											<td>MTH101</td>
											<td>John Doe</td>
											<td>101</td>
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