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
										<h1>199</h1>
										<p>STUDENTS</p>
									</div>
									<div class="col-xs-4 icon">
										<i class="fa fa-users ex-icon"></i>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="status">
									<p class="text-ex"><i class="fa fa-pencil-square-o"></i>10 Absent Today</p>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="stat-item">
								<div class="stats">
									<div class="col-xs-8 count">
										<h1>111</h1>
										<p>TEACHERS</p>
									</div>
									<div class="col-xs-4 icon">
										<i class="fa fa-user-secret danger-icon"></i>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="status">
									<p class="text-danger"><i class="fa fa-exclamation-triangle"></i>5 On Leave Today</p>
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
						<div class="my-msg dash-item">
							<h6 class="item-title"><i class="fa fa-bullhorn"></i>ANNOUNCEMENTS</h6>
							<div class="inner-item dashboard-tabs">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#1" data-toggle="tab"><i class="fa fa-graduation-cap"></i><span>ACADEMICS</span></a>
									</li>

								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="1">
										<?php
										$object->query = "
										  SELECT * FROM announcement   
										  ORDER BY id DESC
										  ";
										$result = $object->get_result();

										foreach ($result as $values) {
										?>
											<div class="announcement-item">
												<h1><?php echo $values['subject'] ?><span class="new">New</span></h2>
													<div class="long_thumb_img">
														<?php if ($values['image'] != '') { ?>
															<img itemprop="image" src="./uploads/images/announcement/<?php echo $values['image'] ?>" alt="<?php echo $values['subject'] ?>" style="width:100%">
														<?php } ?>
													</div>
													<h6><i class="fa fa-clock-o"></i><?php echo date('jS M Y H:i:s', strtotime($values['time'])) ?></h6>
													<p><?php echo $values['message'] ?></p>
													<?php if ($values['link'] != '') { ?>
														<p> <a href="<?php echo $values['link'] ?>">Click here</a> </p>
													<?php } ?>
													<div class="posted-by">
														<p>Thanks,</p>
														<h6>John Doe, Principal</h6>
													</div>
											</div>
										<?php	}
										?>


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