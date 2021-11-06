<?php
//product_action.php
include('../routine.php');
$object = new routine();
if (isset($_POST["action"])) {
    if ($_POST["action"] == 'fetch') {
        $order_column = array('class_room', 'period', 'day', 'status');
        $output = array();
        $main_query = "SELECT * FROM routine_list";
        $search_query = '';
        if (isset($_POST["search"]["value"])) {
            $search_query .= ' WHERE class_room LIKE "%' . $_POST["search"]["value"] . '%" ';
            $search_query .= ' OR period LIKE "%' . $_POST["search"]["value"] . '%" ';
        }
        if (isset($_POST["order"])) {
            $order_query = 'ORDER BY ' . $order_column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $order_query = 'ORDER BY class_room ASC ';
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
            $sub_array[] = $row["day"];
            $sub_array[] = $row["class_room"];
            $sub_array[] = $row["period"];
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
        $success = '';
        $error = '';
        $generatedTable = $object->cleanTable($_POST['course'] . $_POST['branch'] . $_POST['semester']);
        $period = $object->clean_input($_POST['subject']) . "<br>" . $object->clean_input($_POST['teacher']);
        $data = array(
            ':period'              =>    $period,
            ':days'              =>    $object->clean_input($_POST['days']),
        );
        $object->query = "
        UPDATE " . $generatedTable . " SET  " . $object->clean_input($_POST['free_slot']) . " =  :period  
        WHERE day= :days";

        $object->execute($data);
        $period = $object->clean_input($_POST['free_slot']);
        $data = array(
            ':period'              =>    $object->clean_input($_POST['subject']) . "<br>" . $object->clean_input($_POST['teacher']),
            ':days'              =>    $object->clean_input($_POST['days']),
        );
        $object->query = "
        UPDATE " . $object->clean_input($_POST['teacher']) . " SET  " . $period . " =  :period  
        WHERE day= :days";
        $object->execute($data);

        $class_room = $object->get_classroom($_POST['course'], $_POST['branch'], $_POST['semester']);
        $data = array(
            ':class_room'              =>    $class_room,
            ':period'              =>    $period,
            ':days'              =>    $object->clean_input($_POST['days']),
            ':status'              =>    'available',
        );

        $object->query = "
        INSERT INTO routine_list (class_room, period, day,  status)
        VALUES (:class_room , :period , :days , :status)
        ";

        $object->execute($data);

        $success = '<div class="alert alert-success">Slot Added</div>';

        $output = array(
            'success'    =>    $success,
            'error'    =>    $error
        );
        echo json_encode($output);
    }

    if ($_POST["action"] == 'dropDownFill') {
        $branch = $object->get_branch_name($_POST["course"]);
        $course_duration = $object->get_course_duration($_POST["course"]);
        $semester = $object->semester_list($course_duration * 2);
        $output = array(
            'branch'        =>    $branch,
            'semester'    =>    $semester
        );
        echo json_encode($output);
    }

    if ($_POST["action"] == 'delete') {
        $object->query = "
		DELETE FROM drink_quantity_table 
		WHERE quantity_id = '" . $_POST["id"] . "'
		";
        $object->execute();
        echo '<div class="alert alert-success">Quantity Deleted</div>';
    }

    if ($_POST["action"] == 'display') {
        // $generatedTable = $object->cleanTable();
        // session_start();
        $_SESSION["course"] = $_POST['course'];
        $_SESSION["branch"] = $_POST['branch'];
        $_SESSION["semester"] = $_POST['semester'];

        $html = '';
        $days = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday");
        foreach ($days as $day) {
            $html .= $object->get_table_weekends_list($_POST['course'], $_POST['branch'], $_POST['semester'],  $day);
        }
        echo $html;
    }
    if ($_POST["action"] == 'display_on_load') {
        // $generatedTable = $object->cleanTable();
        // session_start();
        $course = $_SESSION["course"];
        $branch = $_SESSION["branch"];
        $semester = $_SESSION["semester"];

        $html = '';
        $days = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday");
        foreach ($days as $day) {
            $html .= $object->get_table_weekends_list($course, $branch, $semester,  $day);
        }
        echo $html;
    }
}
