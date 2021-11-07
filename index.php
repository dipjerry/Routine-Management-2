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
    <!-- <script type="text/javascript">
        function genpdf() {
            var doc = new jsPDF();
            doc.addHTML(document.getElementById('TT'), function() {
                doc.save('timetable.pdf');
            });
            window.alert("Downloaded!");
        }
    </script> -->
    <div align="center" STYLE="margin-top: 30px">
        <button data-scroll-reveal="enter from the bottom after 0.2s" id="adminLoginBtn" class="btn btn-success btn-lg">ADMIN LOGIN
        </button>
    </div>
    <br>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times</span>
                <h2 id="popupHead">Modal Header</h2>
            </div>
            <div class="modal-body" id="LoginType">
                <!--Admin Login Form-->
                <div style="display:none" id="adminForm">
                    <form method="post" id="login_form">
                        <div class="form-group">
                            <input type="text" name="user_email" id="user_email" class="form-control" required data-parsley-type="email" data-parsley-trigger="keyup" placeholder="Enter Email Address..." />
                        </div>
                        <div class="form-group">
                            <input type="password" name="user_password" id="user_password" class="form-control" required data-parsley-trigger="keyup" placeholder="Password" />
                        </div>
                        <div class="form-group">
                            <button type="submit" name="login_button" id="login_button" class="btn btn-primary btn-user btn-block">Login</button>
                        </div>
                    </form>
                </div>
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

<script>
    $(document).ready(function() {
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
                        $('#login_button').val('Login');
                    } else {
                        window.location.href = "<?php echo $object->base_url; ?>/dashboard/admin-dashboard.php";
                    }
                }
            })

        });

    });
</script>