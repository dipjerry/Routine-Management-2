<?php
//product_action.php
include('../routine.php');
$object = new routine();
if (isset($_POST["action"])) {
    if ($_POST["action"] == 'fetch') {
        $order_column = array('course_code', 'branch_code', 'semester', 'classroom');
        $output = array();
        $main_query = "SELECT * FROM classroom_allotment";
        $search_query = '';
        if (isset($_POST["search"]["value"])) {
            $search_query .= ' WHERE course_code LIKE "%' . $_POST["search"]["value"] . '%" ';
            $search_query .= ' OR branch_code LIKE "%' . $_POST["search"]["value"] . '%" ';
            $search_query .= ' OR semester LIKE "%' . $_POST["search"]["value"] . '%" ';
            $search_query .= ' OR classroom LIKE "%' . $_POST["search"]["value"] . '%" ';
        }
        if (isset($_POST["order"])) {
            $order_query = 'ORDER BY ' . $order_column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $order_query = 'ORDER BY course_code ASC ';
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
            $sub_array[] = $object->get_course_name($row["course_code"]);
            $sub_array[] = $object->get_branch_name_from_code($row["branch_code"]);
            $sub_array[] = 'Semester ' . $row["semester"];
            $sub_array[] = $row["classroom"];
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
        var_dump($data);
        var_dump($object->query);
        var_dump("<br>");
        var_dump($object->query);
        $object->execute($data);
        $data = array(
            ':period'              =>    $object->clean_input($_POST['subject']) . "<br>" . $object->clean_input($_POST['teacher']),
            ':days'              =>    $object->clean_input($_POST['days']),
        );
        $object->query = "
        UPDATE " . $object->clean_input($_POST['teacher']) . " SET  " . $object->clean_input($_POST['free_slot']) . " =  :period  
        WHERE day= :days";

        $object->execute($data);

        // $object->execute($data);



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
}
