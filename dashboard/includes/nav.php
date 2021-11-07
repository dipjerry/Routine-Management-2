<div class="row dashboard-top-nav">
    <div class="col-sm-3 logo">
        <h5><i class="fa fa-book"></i>RoutineManagement</h5>
    </div>
    <div class="col-sm-4">
        <!-- <div class="search">
            <i class="fa fa-search"></i>
            <input type="text" placeholder="Search">
        </div> -->
    </div>
    <div class="col-sm-5 notification-area">
        <ul class="top-nav-list">

            <li class="user dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span>
                        <?php
                        if (isset($_SESSION['user_id'])) {
                            echo '<img src="./uploads/images/admin/' . $object->get_image_name($_SESSION['user_id']) . '" alt="user">';
                            echo $_SESSION['user_id'];
                        } else {
                            echo '<img src="../assets/img/parent/parent2.jpg" alt="user">';
                            echo "admin";
                        } ?>
                        <span class="caret"></span></span>
                </a>
                <ul class="dropdown-menu notification-list">
                    <li>
                        <a href="#"><i class="fa fa-cogs"></i> SETTINGS</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-users"></i> USER PROFILE</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-key"></i> CHANGE PASSWORD</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-cogs"></i> SETTINGS</a>
                    </li>
                    <li>
                        <div class="all-notifications">
                            <!-- <a href="" id="logout">LOGOUT</a> -->
                            <a href="./controller/logout.php" id="logout">LOGOUT</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>