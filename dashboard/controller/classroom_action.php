<?php
//product_action.php
include('../routine.php');
$object = new routine();
if (isset($_POST["action"])) {
    if ($_POST["action"] == 'fetch') {
        $order_column = array('classroom_code', 'description', 'status');
        $output = array();
        $main_query = "SELECT * FROM classroom";
        $search_query = '';
        if (isset($_POST["search"]["value"])) {
            $search_query .= ' WHERE classroom_code LIKE "%' . $_POST["search"]["value"] . '%" ';
        }
        if (isset($_POST["order"])) {
            $order_query = 'ORDER BY ' . $order_column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $order_query = 'ORDER BY classroom_code ASC ';
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
            $sub_array[] = $row["classroom_code"];
            $sub_array[] = $row["description"];
            $sub_array[] = $row["status"];
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
            ':classRoomCode'        =>    $_POST["classroom"],
        );
        $object->query = "SELECT * FROM classroom WHERE  classroom_code = :classRoomCode";
        $object->execute($data);
        if ($object->row_count() > 0) {
            $error = '<div class="alert alert-danger">Classroom Already Exists</div>';
        } else {
            $data = array(
                ':classroom_code'                  =>    $object->clean_input($_POST['classroom']),
                ':description'                  =>    $object->clean_input($_POST['description']),
                ':status'              =>    'free',
            );
            $object->query = "
			INSERT INTO classroom (classroom_code, description, status)
			VALUES (:classroom_code, :description, :status)
			";
            $object->execute($data);
            $success = '<div class="alert alert-success">ClassRoom Added</div>';
        }
        $output = array(
            'error'        =>    $error,
            'success'    =>    $success
        );
        echo json_encode($output);
    }
}
