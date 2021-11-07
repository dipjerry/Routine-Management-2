<?php

//login_action.php

include('../routine.php');
$object = new routine();
if (isset($_POST["user_email"])) {
    sleep(2);
    $error = '';
    $data = array(
        ':user_id'    =>    $_POST["user_email"]
    );

    $object->query = "
		SELECT * FROM useraccounts 
		WHERE account_username = :user_id
	";

    $object->execute($data);

    $total_row = $object->row_count();

    if ($total_row == 0) {
        $error = '<div class="alert alert-danger">Wrong Email Address</div>';
    } else {
        $result = $object->statement_result();
        foreach ($result as $row) {
            if (md5($_POST["user_password"]) == $row["account_password"]) {
                $_SESSION['user_id'] = $row['account_username'];
                $_SESSION['user_name'] = $row['account_name'];
            } else {
                $error = '<div class="alert alert-danger">Wrong Password</div>';
            }
        }
    }

    $output = array(
        'error'        =>    $error
    );

    echo json_encode($output);
}
