<?php
//product_action.php
include('../routine.php');
$object = new routine();
if (isset($_POST["action"])) {
    if ($_POST["action"] == 'fetch') {
        $order_column = array('course_name', 'course_code', 'course_duration', 'description');
        $output = array();
        $main_query = "SELECT * FROM course";
        $search_query = '';
        if (isset($_POST["search"]["value"])) {
            $search_query .= ' WHERE course_name LIKE "%' . $_POST["search"]["value"] . '%" ';
            $search_query .= 'OR course_code LIKE "%' . $_POST["search"]["value"] . '%" ';
        }
        if (isset($_POST["order"])) {
            $order_query = 'ORDER BY ' . $order_column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $order_query = 'ORDER BY course_name ASC ';
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
            $sub_array[] = $row["course_name"];
            $sub_array[] = $row["course_code"];
            $sub_array[] = $row["course_duration"];
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
            ':course'        =>    $_POST["course"],
            ':courseCode'        =>    $_POST["courseCode"],
        );
        $object->query = "SELECT * FROM course WHERE course_name = :course AND course_code = :courseCode";
        $object->execute($data);
        if ($object->row_count() > 0) {
            $error = '<div class="alert alert-danger">Course Already Exists</div>';
        } else {
            $data = array(
                ':course'                  =>    $object->clean_input($_POST['course']),
                ':courseCode'              =>    $object->clean_input($_POST['courseCode']),
                ':courseDuration'              =>    $object->clean_input($_POST['courseDuration']),
                ':description'             =>    $object->clean_input($_POST['description'])
            );
            $object->query = "
			INSERT INTO course (course_name, course_code,course_duration ,description)
			VALUES (:course, :courseCode, :courseDuration, :description)
			";
            $object->execute($data);
            $success = '<div class="alert alert-success">Teacher Added</div>';
        }
        $output = array(
            'error'        =>    $error,
            'success'    =>    $success
        );
        echo json_encode($output);
    }

    if ($_POST["action"] == 'edit') {
        $error = '';
        $success = '';
        $tcode = $object->clean_input($_POST["form_hidden_id"]);
        $data = array(
            ':hidden_code'        =>    $tcode,
            ':id'        =>    $_POST['id'],
        );
        $object->query = "SELECT * FROM course WHERE course_code = :hidden_code AND id != :id";
        $object->execute($data);

        if ($object->row_count() > 0) {
            $error = '<div class="alert alert-danger">Duplicate Course code!!!</div>';
        } else {
            $data = array(
                ':hidden_code'              =>    $tcode,
                ':course'             =>    $object->clean_input($_POST["course"]),
                ':duration'             =>    $object->clean_input($_POST["courseDuration"]),
                ':description'             =>    $object->clean_input($_POST["description"]),
            );
            $object->query = "
			UPDATE course
			SET course_name = :course, 
			course_duration = :duration, 
			description = :description   
			WHERE course_code = :hidden_code
			";
            $object->execute($data);
            $success = '<div class="alert alert-success">Course Updated</div>';
        }
        $output = array(
            'error'        =>    $error,
            'success'    =>    $success
        );
        echo json_encode($output);
    }

    if ($_POST["action"] == 'fetch_single') {
        $object->query = "
		SELECT * FROM course 
		WHERE id = '" . $_POST["id"] . "'
		";
        $result = $object->get_result();
        $data = array();
        foreach ($result as $row) {
            $data['course'] = $row['course_name'];
            $data['course_code'] = $row['course_code'];
            $data['course_duration'] = $row['course_duration'];
            $data['description'] = $row['description'];
            $data['id'] = $row['id'];
        }
        echo json_encode($data);
    }

    if ($_POST["action"] == 'delete') {
        $id = $_POST["id"];

        $object->query = "
		DELETE FROM course 
		WHERE id = '" . $id . "'
		";
        $object->execute();

        echo '<div class="alert alert-success">Course Deleted</div>';
    }
}
