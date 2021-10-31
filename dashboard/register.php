<?php
include('routine.php');

$object = new routine();

if ($object->Is_set_up_done()) {
    if ($object->is_login()) {
        header("location:" . $object->base_url . "dashboard.php");
    } else {
        header("location:" . $object->base_url . "index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Restaurant Management System using PHP - Register</title>

    <!-- Custom fonts for this template-->
    <!-- <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../assets/vendor/parsley/parsley.css" />

</head>

<body class="bg-gradient-success">

    <!-- <div class="container"> -->

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-9 col-lg-9 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <form method="post" id="register_form" enctype="multipart/form-data">
                        <div class="p-5">
                            <span id="message"></span>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Register Admin</h1>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="account_name" id="account_name" class="form-control" required data-parsley-maxlength="175" data-parsley-trigger="keyup" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="account_username" id="account_username" class="form-control" required data-parsley-type="alphanum" data-parsley-trigger="keyup" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" name="account_email" id="account_email" class="form-control" required data-parsley-type="email" data-parsley-trigger="keyup" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="account_password" id="account_password" class="form-control" required data-parsley-trigger="keyup" autocomplete="new-password" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>User Image</label>
                                        <input type="file" name="profile_image" id="account_profile_image" class="form-control" required />
                                    </div>
                                </div>

                                <div class="col-md-12" align="center">
                                    <div class="form-group">
                                        <br />
                                        <input type="hidden" name="action" id="action" value="Add">
                                        <button type="submit" name="register_button" id="register_button" class="btn btn-primary btn-user">Set Up</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <script type="text/javascript" src="../assets/vendor/parsley/dist/parsley.min.js"></script>

</body>

</html>

<script>
    $(document).ready(function() {

        $('#register_form').parsley();

        $('#register_form').on('submit', function(event) {
            event.preventDefault();
            console.log(new FormData(this));
            if ($('#register_form').parsley().isValid()) {
                $.ajax({
                    url: "./controller/register_action.php",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#register_button').attr('disabled', 'disabled');
                        $('#register_button').val('wait...');
                    },
                    success: function(data) {
                        $('#register_button').attr('disabled', false);
                        if (data.error != '') {
                            $('#message').html(data.error);
                        } else {
                            // window.location.href = "<?php echo $object->base_url; ?>";
                        }
                    }
                })
            }
        });

    });
</script>