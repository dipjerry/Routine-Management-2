<?php
//product_action.php
include('../routine.php');
$object = new routine();
if (isset($_POST["action"])) {
    if ($_POST["action"] == 'fetch') {
        $order_column = array('name', 'subject_code', 'course', 'semester', 'branch', 'description');
        $output = array();
        $main_query = "SELECT * FROM subject";
        $search_query = '';
        if (isset($_POST["search"]["value"])) {
            $search_query .= ' WHERE name LIKE "%' . $_POST["search"]["value"] . '%" ';
            $search_query .= ' OR subject_code LIKE "%' . $_POST["search"]["value"] . '%" ';
            $search_query .= ' OR course LIKE "%' . $_POST["search"]["value"] . '%" ';
            $search_query .= ' OR branch LIKE "%' . $_POST["search"]["value"] . '%" ';
        }
        if (isset($_POST["order"])) {
            $order_query = 'ORDER BY ' . $order_column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $order_query = 'ORDER BY name ASC ';
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
            $sub_array[] = $row["name"];
            $sub_array[] = $row["subject_code"];
            $sub_array[] = $object->get_course_name($row["course"]);
            $sub_array[] = $object->get_branch_name_from_code($row["branch"]);
            $sub_array[] = 'Semester ' . $row["semester"];
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

        $success = '';
        $data = array(
            ':subject_code'        =>    $_POST["subject_code"],
        );
        $object->query = "SELECT * FROM subject WHERE  subject_code = :subject_code";
        $object->execute($data);
        if ($object->row_count() > 0) {
            $error = '<div class="alert alert-danger">Subject Already Exists</div>';
        } else {
            $data = array(
                ':subject'                  =>    $object->clean_input($_POST['subject']),
                ':subject_code'                  =>    $object->clean_input($_POST['subject_code']),
                ':course_code'                  =>    $object->clean_input($_POST['course']),
                ':branch_code'                  =>    $object->clean_input($_POST['branch']),
                ':semester'                  =>    $object->clean_input($_POST['semester']),
                ':description'                           =>    $object->clean_input($_POST['description']),
                ':status'                           =>    'no',
            );
            $object->query = "
			INSERT INTO subject (name ,subject_code,course, semester, branch,description,status)
			VALUES (:subject,:subject_code,:course_code, :semester, :branch_code,:description,:status)
			";
            $object->execute($data);
            $success = '<div class="alert alert-success">Subjects Added</div>';
        }
        $output = array(
            'success'    =>    $success
        );
        echo json_encode($output);
    }
    if ($_POST["action"] == 'delete') {
        $id = $_POST["id"];
        $object->query = "SELECT * FROM subject WHERE id = '$id'";
        $result = $object->get_result();
        foreach ($result as $row) {
            $resultset[] = $row;
        }
        echo '<div class="alert alert-success">Product Deleted</div>';
    }

    if ($_POST["action"] == 'edit') {
        // var_dump("hello");
        $error = '';
        $success = '';
        $tcode = $object->clean_input($_POST["form_hidden_id"]);
        $data = array(
            ':hidden_code'        =>    $tcode,
            ':id'        =>    $_POST['id'],
        );
        $object->query = "SELECT * FROM subject WHERE subject_code = :hidden_code AND id != :id";
        $object->execute($data);

        if ($object->row_count() > 0) {
            $error = '<div class="alert alert-danger">Duplicate subject code!!!</div>';
        } else {
            $data = array(
                ':hidden_code'              =>    $tcode,
                ':name'              =>    $object->e($_POST["subject"]),
                ':course'             =>    $object->clean_input($_POST["course"]),
                ':semester'             =>    $object->clean_input($_POST["semester"]),
                ':branch'            =>    $object->clean_input($_POST["branch"]),
                ':description'             =>    $object->clean_input($_POST["description"]),
            );
            $object->query = "
			UPDATE subject 
			SET name = :name, 
			course = :course, 
			semester = :semester,   
			branch = :branch,   
			description = :description   
			WHERE subject_code = :hidden_code
			";
            $object->execute($data);
            $success = '<div class="alert alert-success">Subject Updated</div>';
        }
        $output = array(
            'error'        =>    $error,
            'success'    =>    $success
        );
        echo json_encode($output);
    }

    if ($_POST["action"] == 'fetch_single') {
        $object->query = "
		SELECT * FROM subject 
		WHERE id = '" . $_POST["id"] . "'
		";
        $result = $object->get_result();
        $data = array();
        foreach ($result as $row) {
            $data['name'] = $row['name'];
            $data['subject_code'] = $row['subject_code'];
            $data['course'] = $row['course'];
            $data['semester'] = $row['semester'];
            $data['branch'] = $row['branch'];
            $data['description'] = $row['description'];
            $data['id'] = $row['id'];
        }
        echo json_encode($data);
    }
}
