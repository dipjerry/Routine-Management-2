<?php
include('./dashboard/routine.php');
$object = new routine();


if (!$object->Is_set_up_done()) {
    header("location:" . $object->base_url . "dashboard/register.php");
}
if ($object->is_login()) {
    header("location:" . $object->base_url . "dashboard/admin-dashboard.php");
}
if (isset($_GET['generated']) && $_GET['generated'] == "false") {
    unset($_GET['generated']);
    echo '<script>alert("Timetable not generated yet!!");</script>';
}
// require("./class/connection.php");
require("./class/loginFunction.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Routine Management System</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/css/flexslider.css" rel="stylesheet" />
    <link href="assets/css/landing.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <div class="navbar navbar-inverse navbar-fixed-top " id="menu">
        <div class="container">
            <div align="center">
                <h3 align="center">Routine Management System</h3>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <img src="assets/img/routine.jpg" class="img-fluid" alt="Building" style="width:100% ; height:350px ; margin-top:9% ">
    </div>

    <div align="center" STYLE="margin-top: 30px">
        <button data-scroll-reveal="enter from the bottom after 0.2s" id="adminLoginBtn" class="btn btn-success btn-lg">ADMIN LOGIN
        </button>
    </div>
    <br>
    <!-- The Modal -->
    <div id="deleteDetailModal" style="z-index:9999 !important;" class="modal">
        <div class="modal-dialog">
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
    <div id="loginModal" style="z-index:9999 !important;" class="modal modal-lg">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title bill_details" id="modal_title">LOGIN</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <span id="message"></span>
                <span id="form_message"></span>
                <form method="post" id="login_form">
                    <div class="modal-body">
                        <!--Admin Login Form-->
                        <div class="form-group">
                            <input type="text" name="user_email" id="user_email" class="form-control" required data-parsley-type="email" data-parsley-trigger="keyup" placeholder="Enter Email Address..." />
                        </div>
                        <div class="form-group">
                            <input type="password" name="user_password" id="user_password" class="form-control" required data-parsley-trigger="keyup" placeholder="Password" />
                        </div>


                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="submit" name="login_button" id="login_button" class="btn btn-success btn-user btn-block">Login</button>
                        </div>
                    </div>
                </form>

            </div>
            <!--Faculty Login Form-->
        </div>
    </div>

    <div class="container">
        <div class="row set-row-pad">
            <div class="col-lg-4 col-md-4 col-sm-4   col-lg-offset-1 col-md-offset-1 col-sm-offset-1 " data-scroll-reveal="enter from the bottom after 0.4s">

            </div>
        </div>
    </div>
</body>

</html>
<script src="./assets/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#adminLoginBtn').on('click', function(event) {
            $('#loginModal').modal('show');
        });
        $('#login_form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "./dashboard/controller/login_action.php",
                method: "POST",
                data: $(this).serialize(),
                dataType: 'json',

                success: function(data) {
                    $('#login_button').attr('disabled', false);
                    if (data.error != '') {
                        $('#error').html(data.error);
                    } else {
                        window.location.href = "<?php echo $object->base_url; ?>/dashboard/admin-dashboard.php";
                    }
                }
            })

        });

    });
</script>