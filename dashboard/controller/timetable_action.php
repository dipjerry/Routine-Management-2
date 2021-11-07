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
           
            <button type="button" name="delete_button" class="btn btn-danger btn-circle btn-sm delete_button" data-id="' . $row["id"] . '" data-teacher="' . $row["teacher"] . '" data-table_name="' . $row["table_name"] . '" data-day="' . $row["day"] . '" data-period="' . $row["period"] . '" ><i class="fa fa-remove"></i></button>
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
        // $period = $object->clean_input($object->get_subject_bycode($_POST['subject'])) . "<br>" . $object->clean_input($_POST['teacher']);
        $period = $object->clean_input($_POST['subject']) . "<br>" . $object->clean_input($_POST['teacher']);
        $free_period = $object->clean_input($_POST['free_slot']);

        $data = array(
            ':period'              =>    $period,
            ':days'              =>    $object->clean_input($_POST['days']),
        );
        $object->query = "
        UPDATE " . $generatedTable . " SET  " . $free_period . " =  :period  
        WHERE day= :days";

        $object->execute($data);
        $object->query = "
        UPDATE " . $object->clean_input($_POST['teacher']) . " SET  " . $free_period . " =  :period  
        WHERE day= :days";
        $object->execute($data);

        $class_room = $object->get_classroom($_POST['course'], $_POST['branch'], $_POST['semester']);
        $data = array(
            ':class_room'              =>    $class_room,
            ':period'              =>    $free_period,
            ':days'              =>    $object->clean_input($_POST['days']),
            ':teacher'              =>    $object->clean_input($_POST['teacher']),
            ':status'              =>    'available',
        );

        $object->query = "
        INSERT INTO routine_list (class_room, period, day,teacher,  status)
        VALUES (:class_room , :period , :days ,:teacher, :status)
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
        $id = $_POST["id"];
        $teacher = $_POST["teacher"];
        $day = $_POST["day"];
        $free_period = $_POST["period"];
        $table_name = $_POST["table_name"];

        $object->query = "
		DELETE FROM routine_list 
		WHERE id = '" . $id . "'
		";
        $object->execute();
        $data = array(
            ':period'              =>    '',
            ':days'              =>    $day,
        );
        $object->query = "
        UPDATE " . $table_name . " SET  " . $free_period . " =  :period  
        WHERE day= :days";

        $object->execute($data);

        $data = array(
            ':period'              =>    '',
            ':days'              =>    $day,
        );
        $object->query = "
        UPDATE " . $teacher . " SET  " . $free_period . " =  :period  
        WHERE day= :days";

        $object->execute($data);

        echo '<div class="alert alert-success">teacher Deleted</div>';
    }

    if ($_POST["action"] == 'cancel') {
        $success = '';
        $error = '';
        $course = $_SESSION["course"];
        $branch = $_SESSION["branch"];
        $semester = $_SESSION["semester"];
        $generatedTable = $object->cleanTable($course . $branch . $semester);
        $classroom = $object->get_classroom($course, $branch, $semester);
        $data = array(
            ':subject'              =>    'class_cancel',
            ':classroom'            =>    $classroom,
            ':day'                  =>    $object->clean_input($_POST['day']),
            ':period'               =>    $object->clean_input($_POST['period']),
        );
        $object->query = "
        INSERT INTO message (subject, classroom, day,  period)
        VALUES (:subject , :classroom , :day , :period)";

        $object->execute($data);

        $success = '<div class="alert alert-success">class canceled</div>';

        $output = array(
            'success'    =>    $success,
            'error'    =>    $error
        );
        echo json_encode($output);
    }
    if ($_POST["action"] == 'active') {

        $success = '';
        $error = '';
        $course = $_SESSION["course"];
        $branch = $_SESSION["branch"];
        $semester = $_SESSION["semester"];
        $generatedTable = $object->cleanTable($course . $branch . $semester);
        $classroom = $object->get_classroom($course, $branch, $semester);
        $data = array(
            ':classroom'            =>    $classroom,
            ':day'                  =>    $object->clean_input($_POST['day']),
            ':period'               =>    $object->clean_input($_POST['period']),
            ':status'              =>    '',
        );
        $object->query = "
        UPDATE message SET subject = :status where classroom = :classroom and day = :day and period = :period";
        $object->execute($data);

        $success = '<div class="alert alert-success">class canceled</div>';

        $output = array(
            'success'    =>    $success,
            'error'    =>    $error
        );
        echo json_encode($output);
    }
}
