
<?php
include('../routine.php');
$object = new routine();
var_dump("hello");
session_unset();
session_destroy();
header("location:" . $object->base_url);
?>  