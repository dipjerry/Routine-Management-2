<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <title>RoutineManagement - Responsive Education Template</title>

    <!-- Styles -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../assets/css/owl.carousel.min.css" rel="stylesheet" media="screen">
    <link href="../assets/css/custom.css" rel="stylesheet" media="screen">
    <link href="../assets/css/owl.theme.default.min.css" rel="stylesheet" media="screen">
    <link href="../assets/css/jquery.dataTables.min.css" rel="stylesheet" media="screen">
    <link href="../assets/css/custom.css" rel="stylesheet" media="screen">
    <link href="../assets/css/responsive.dataTables.min.css" rel="stylesheet" media="screen">
    <link href="../assets/css/style.css" rel="stylesheet" media="screen">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link href="../assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/parsley/parsley.css" />
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

</head>

<body>
    <?php
    include('routine.php');

    $object = new routine();
    if ($object->Is_set_up_done()) {
        if (!$object->is_login()) {
            header("location:" . $object->base_url);
        }
    }
    ?>