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
					<h5 class="page-title"><i class="fa fa-home"></i>HOME</h5>
					<div class="section-divider"></div>
					<div class="dashboard-stats">
						<div class="col-sm-6 col-md-3">
							<div class="stat-item">
								<div class="stats">
									<div class="col-xs-8 count">
										<h1>999</h1>
										<p>ASSIGNMENTS</p>
									</div>
									<div class="col-xs-4 icon">
										<i class="fa fa-code ex-icon"></i>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="status">
									<p class="text-ex"><i class="fa fa-pencil-square-o"></i>1 Submission Tomorrow</p>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="stat-item">
								<div class="stats">
									<div class="col-xs-8 count">
										<h1>65.8%</h1>
										<p>ATTENDENCE</p>
									</div>
									<div class="col-xs-4 icon">
										<i class="fa fa-line-chart danger-icon"></i>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="status">
									<p class="text-danger"><i class="fa fa-exclamation-triangle"></i>Below 70%</p>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="clearfix visible-sm"></div>
						<div class="col-sm-6 col-md-3">
							<div class="stat-item">
								<div class="stats">
									<div class="col-xs-8 count">
										<h1>900</h1>
										<p>EVENTS</p>
									</div>
									<div class="col-xs-4 icon">
										<i class="fa fa-flag look-icon"></i>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="status">
									<p class="text-look"><i class="fa fa-clock-o"></i>1 Event tomorrow</p>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="stat-item">
								<div class="stats">
									<div class="col-xs-8 count">
										<h1>799</h1>
										<p>MESSAGES</p>
									</div>
									<div class="col-xs-4 icon">
										<i class="fa fa-envelope-o success-icon"></i>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="status">
									<p class="text-success"><i class="fa fa-folder-open-o"></i>10 Unread messages</p>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 clear-padding-xs">
					<div class="col-sm-8">
						<div>
							<div class="my-msg dash-item">
								<h6 class="item-title"><i class="fa fa-bar-chart"></i>TODAY'S STUDENT ATTENDENCE</h6>
								<div class="inner-item">
									<div class="summary-chart">
										<canvas id="studentAttendenceBar"></canvas>
										<div class="chart-legends">
											<span class="red">ABSENT</span>
											<span class="orange">ON LEAVE</span>
											<span class="green">PRESENT</span>
										</div>
										<div class="chart-title">
											<h6 class="bottom-title">STUDENT ATTENDENCE BAR</h6>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div>
							<div class="my-msg dash-item">
								<h6 class="item-title"><i class="fa fa-calendar"></i>TODAY'S TIMETABLE</h6>
								<div class="inner-item">
									<div class="timetable-item">
										<div class="col-xs-3 clear-padding">
											<p><span class="time">10 AM</span></p>
										</div>
										<div class="col-xs-9">
											<p class="title">Mathematics (MTH101)</p>
											<p class="sent-by"><i class="fa fa-map-marker"></i> ROOM NO - 601</p>
											<p class="class-teacher"><i class="fa fa-user"></i> JOHN DOE</p>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="timetable-item">
										<div class="col-xs-3 clear-padding">
											<p><span class="time">11 AM</span></p>
										</div>
										<div class="col-xs-9">
											<p class="title">Physics (PHY202)</p>
											<p class="sent-by"><i class="fa fa-map-marker"></i> ROOM NO - 601</p>
											<p class="class-teacher"><i class="fa fa-user"></i> JOHN DOE</p>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="timetable-item">
										<div class="col-xs-3 clear-padding">
											<p><span class="time">12 PM</span></p>
										</div>
										<div class="col-xs-9">
											<p class="title">Biology (BIO101)</p>
											<p class="sent-by"><i class="fa fa-map-marker"></i> ROOM NO - 601</p>
											<p class="class-teacher"><i class="fa fa-user"></i> JOHN DOE</p>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="timetable-item">
										<div class="col-xs-3 clear-padding">
											<p><span class="time">01 PM</span></p>
										</div>
										<div class="col-xs-9">
											<p class="title">MATH (MTH101)</p>
											<p class="sent-by"><i class="fa fa-map-marker"></i> ROOM NO - 601</p>
											<p class="class-teacher"><i class="fa fa-user"></i> JOHN DOE</p>
										</div>
										<div class="clearfix"></div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 clear-padding-xs">
					<div class="col-md-8">
						<div class="my-msg dash-item">
							<h6 class="item-title"><i class="fa fa-bullhorn"></i>ANNOUNCEMENTS</h6>
							<div class="inner-item dashboard-tabs">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#1" data-toggle="tab"><i class="fa fa-graduation-cap"></i><span>ACADEMICS</span></a>
									</li>
									<li>
										<a href="#2" data-toggle="tab"><i class="fa fa-users"></i><span>ADMISSIONS</span></a>
									</li>
									<li>
										<a href="#3" data-toggle="tab"><i class="fa fa-trophy"></i><span>SPORTS</span></a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="1">
										<div class="announcement-item">
											<h5>Guest lecture on fine arts by Smith.<span class="new">New</span></h5>
											<h6><i class="fa fa-clock-o"></i>06-24-2017, 13:34</h6>
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
											<div class="posted-by">
												<p>Thanks,</p>
												<h6>John Doe, Principal</h6>
											</div>
										</div>
										<div class="announcement-item">
											<h5>Guest lecture on fine arts by Smith</h5>
											<h6><i class="fa fa-clock-o"></i>06-24-2017, 13:34</h6>
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
											<div class="posted-by">
												<p>Thanks,</p>
												<h6>John Doe, Principal</h6>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="2">
										<div class="announcement-item">
											<h5>2</h5>
										</div>
									</div>
									<div class="tab-pane" id="3">
										<div class="announcement-item">
											<h5>3</h5>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div>
							<div class="my-msg dash-item">
								<h6 class="item-title"><i class="fa fa-pie-chart"></i>STUDENTS</h6>
								<div class="chart-item">
									<canvas id="studentPie" height=200px></canvas>
									<div class="chart-legends">
										<span class="red">ABSENT</span>
										<span class="orange">PRESENT</span>
										<span class="green">LEAVE</span>
									</div>
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
<?php include('includes/footer.php') ?>