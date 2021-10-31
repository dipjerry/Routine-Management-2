<?php
//product_action.php
include('../routine.php');
$object = new routine();
if (isset($_POST["action"])) {
    if ($_POST["action"] == 'fetch') {
        $order_column = array('course', 'branch', 'branch_code', 'description');
        $output = array();
        $main_query = "SELECT * FROM branch";
        $search_query = '';
        if (isset($_POST["search"]["value"])) {
            $search_query .= ' WHERE course LIKE "%' . $_POST["search"]["value"] . '%" ';
            $search_query .= 'OR branch LIKE "%' . $_POST["search"]["value"] . '%" ';
            $search_query .= 'OR branch_code LIKE "%' . $_POST["search"]["value"] . '%" ';
        }
        if (isset($_POST["order"])) {
            $order_query = 'ORDER BY ' . $order_column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $order_query = 'ORDER BY branch ASC ';
        }
        $limit_query = '';
        if ($_POST["length"] != -1) {
            $limit_query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $object->query = $main_query . $search_query . $order_query;
        $object->execute();
        $filtered_rows = $object->row_count();
        $object->query .= $limit_query;
        $result = $object->get_result();
        $object->query = $main_query;
        $object->execute();
        $total_rows = $object->row_count();
        $data = array();
        foreach ($result as $row) {
            $sub_array = array();
            $sub_array[] = $object->get_course_name($row["course"]);
            $sub_array[] = $row["branch"];
            $sub_array[] = $row["branch_code"];
            $sub_array[] = $row["description"];
            $sub_array[] = '
            <div align="center">
            <button type="button" name="edit_button" class="btn btn-warning btn-circle btn-sm edit_button" data-id="' . $row["id"] . '"><i class="fa fa-edit"></i></button>
            &nbsp;
            <button type="button" name="delete_button" class="btn btn-danger btn-circle btn-sm delete_button" data-id="' . $row["id"] . '" ><i class="fa fa-remove"></i></button>
            </div>
            ';
            $data[] = $sub_array;
        }

        $output = array(
            "draw"                =>     intval($_POST["draw"]),
            "recordsTotal"        =>     $total_rows,
            "recordsFiltered"     =>     $filtered_rows,
            "data"                =>     $data
        );
        echo json_encode($output);
    }

    if ($_POST["action"] == 'Add') {
        $error = '';
        $success = '';
        $data = array(
            ':branchCode'        =>    $_POST["branchCode"],
        );
        $object->query = "SELECT * FROM branch WHERE  branch_code = :branchCode";
        $object->execute($data);
        if ($object->row_count() > 0) {
            $error = '<div class="alert alert-danger">Course Already Exists</div>';
        } else {
            $data = array(
                ':course'                  =>    $object->clean_input($_POST['course']),
                ':branch'                  =>    $object->clean_input($_POST['branch']),
                ':branchCode'              =>    $object->clean_input($_POST['branchCode']),
                ':description'             =>    $object->clean_input($_POST['description'])
            );
            $object->query = "
			INSERT INTO branch (course,branch, branch_code ,description)
			VALUES (:course,:branch, :branchCode, :description)
			";
            $object->execute($data);
            $success = '<div class="alert alert-success">Branch Added</div>';
        }
        $output = array(
            'error'        =>    $error,
            'success'    =>    $success
        );
        echo json_encode($output);
    }
}
