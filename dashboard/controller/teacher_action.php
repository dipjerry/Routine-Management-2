<?php
//product_action.php
include('../routine.php');
$object = new routine();
if (isset($_POST["action"])) {
    if ($_POST["action"] == 'fetch') {
        $order_column = array('teacher_code', 'name', 'gender', 'phone', 'email', 'subject', '');
        $output = array();
        $main_query = "SELECT * FROM teacher_list";
        $search_query = '';
        if (isset($_POST["search"]["value"])) {
            $search_query .= ' WHERE name LIKE "%' . $_POST["search"]["value"] . '%" ';
            $search_query .= 'OR alias LIKE "%' . $_POST["search"]["value"] . '%" ';
        }
        if (isset($_POST["order"])) {
            $order_query = 'ORDER BY ' . $order_column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $order_query = 'ORDER BY id DESC ';
        }
        $limit_query = '';
        if ($_POST["length"] != -1) {
            $limit_query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $object->query = $main_query . $search_query . $order_query;
        $object->execute();
        $filtered_rows = $object->row_count();
        $object->query .= $limit_query;
        // var_dump($object->query);
        $result = $object->get_result();
        $object->query = $main_query;
        $object->execute();
        $total_rows = $object->row_count();
        // var_dump($object->query);
        $data = array();
        foreach ($result as $row) {
            $sub_array = array();
            $sub_array[] = $row["teacher_code"];
            $sub_array[] = html_entity_decode($row["name"]) . ' (' . $row["alias"] . ')';
            $sub_array[] = $row["gender"];
            $sub_array[] = $row["phone"];
            $sub_array[] = $row["email"];
            $sub_array[] = $object->get_subject_bycode($row["subject"]);
            $sub_array[] = '<img src="./uploads/images/faculty/' . $row["display_image"] . '" class="img-fluid img-thumbnail" width="100" height="100" />';
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
            "recordsTotal"      =>  $total_rows,
            "recordsFiltered"     =>     $filtered_rows,
            "data"                =>     $data
        );
        echo json_encode($output);
    }

    if ($_POST["action"] == 'Add') {
        $error = '';
        $success = '';
        $data = array(
            ':teacher_email'        =>    $_POST["email"],
            ':teacher_alias'        =>    $_POST["alias"],
            ':teacher_code'        =>    $_POST["tcode"]
        );
        $object->query = "SELECT * FROM teacher_list WHERE email = :teacher_email OR alias = :teacher_alias or teacher_code =:teacher_code ";
        $object->execute($data);
        $tname = '';

        $tcode = $object->clean_input($_POST["tcode"]);

        if ($_POST["mname"] != '') {
            $tname = $_POST["fname"] . ' ' . $_POST["mname"] . ' ' . $_POST["lname"];
        } else {
            $tname = $_POST["fname"] . ' ' . $_POST["lname"];
        }

        if ($object->row_count() > 0) {
            $error = '<div class="alert alert-danger">Email or Alias Already Exists</div>';
        } else {
            $display_image = '';
            if ($_FILES["display_image"]["name"] != '') {
                $display_image = upload_image();
            } else {
                $display_image = $object->make_avatar(strtoupper($_POST["fname"]));
            }
            $data = array(
                ':code'              =>    $tcode,
                ':name'              =>    $object->clean_input($tname),
                ':alias'             =>    $object->e($_POST["alias"]),
                ':subject'             =>    $object->e($_POST["subject"]),
                ':gender'            =>    $object->clean_input($_POST["gender"]),
                ':phone'             =>    $_POST["phone"],
                ':email'             =>    $object->clean_input($_POST["email"]),
                ':display_image'     =>    $display_image,
            );
            $object->query = "
			INSERT INTO teacher_list (teacher_code, name ,alias,subject, gender, phone,email, display_image)
			VALUES (:code, :name, :alias, :subject , :gender, :phone, :email , :display_image)
			";
            $object->execute($data);
            $object->query =  "CREATE TABLE " . $tcode . " (
                day VARCHAR(10) PRIMARY KEY, 
                period1 VARCHAR(30),
                period2 VARCHAR(30),
                period3 VARCHAR(30),
                period4 VARCHAR(30),
                period5 VARCHAR(30),
                period6 VARCHAR(30)
                )";
            $object->execute();
            $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
            for ($i = 0; $i < 6; $i++) {
                $day = $days[$i];
                $object->query = "INSERT into " . $tcode . " VALUES('$day','','','','','','')";
                $object->execute();
            }

            $success = '<div class="alert alert-success">Teacher Added</div>';
        }
        $output = array(
            'error'        =>    $error,
            'success'    =>    $success
        );
        echo json_encode($output);
    }
    // var_dump($_POST);
    if ($_POST["action"] == 'edit') {
        // var_dump("hello");
        $error = '';
        $success = '';
        $success = '';
        $data = array(
            ':id'        =>    $_POST["id"],
            ':teacher_alias'        =>    $_POST["alias"],
            ':teacher_code'        =>    $_POST["form_hidden_id"]
        );
        $object->query = "SELECT * FROM teacher_list WHERE alias = :teacher_alias 
        AND teacher_code =:teacher_code AND id != :id";
        $object->execute($data);
        $tname = '';

        $tcode = $object->clean_input($_POST["form_hidden_id"]);

        if ($_POST["mname"] != '') {
            $tname = $_POST["fname"] . ' ' . $_POST["mname"] . ' ' . $_POST["lname"];
        } else {
            $tname = $_POST["fname"] . ' ' . $_POST["lname"];
        }

        if ($object->row_count() > 0) {
            $error = '<div class="alert alert-danger">Email or Alias Already Exists</div>';
        } else {
            $display_image = '';
            if ($_FILES["display_image"]["name"] != '') {
                $display_image = upload_image();
                $data = array(
                    ':hidden_code'              =>    $tcode,
                    ':name'              =>    $object->clean_input($tname),
                    ':alias'             =>    $object->e($_POST["alias"]),
                    ':subject'             =>    $object->e($_POST["subject"]),
                    ':gender'            =>    $object->clean_input($_POST["gender"]),
                    ':phone'             =>    $_POST["phone"],
                    ':email'             =>    $object->clean_input($_POST["email"]),
                    ':display_image'     =>    $display_image,
                );
                $object->query = "
			UPDATE teacher_list 
			SET name = :name, 
			alias = :alias, 
			subject = :subject,   
			gender = :gender,   
			phone = :phone,   
			email = :email,   
			display_image = :display_image,   
			WHERE teacher_code = :hidden_code
			";
                $object->execute($data);
                $success = '<div class="alert alert-success">Product Updated</div>';
            } else {
                $data = array(
                    ':hidden_code'              =>    $tcode,
                    ':name'              =>    $object->clean_input($tname),
                    ':alias'             =>    $object->e($_POST["alias"]),
                    ':subject'             =>    $object->e($_POST["subject"]),
                    ':gender'            =>    $object->clean_input($_POST["gender"]),
                    ':phone'             =>    $_POST["contact"],
                    ':email'             =>    $object->clean_input($_POST["email"]),
                );
                $object->query = "
			UPDATE teacher_list 
			SET name = :name, 
			alias = :alias, 
			subject = :subject,   
			gender = :gender,   
			phone = :phone,   
			email = :email   
			WHERE teacher_code = :hidden_code
			";
                $object->execute($data);
                $success = '<div class="alert alert-success">Product Updated</div>';
            }
        }
        $output = array(
            'error'        =>    $error,
            'success'    =>    $success
        );
        echo json_encode($output);
    }

    if ($_POST["action"] == 'fetch_single') {
        $object->query = "
		SELECT * FROM teacher_list 
		WHERE id = '" . $_POST["id"] . "'
		";
        $result = $object->get_result();
        $data = array();
        foreach ($result as $row) {
            $parts = explode(" ", $row['name']);
            $data['fname'] = '';
            $data['mname'] = '';
            $data['lname'] = '';
            if (count($parts) == 2) {
                $data['fname'] = $parts[0];
                $data['mname'] = '';
                $data['lname'] = $parts[1];
            }
            if (count($parts) == 3) {
                $data['fname'] = $parts[0];
                $data['mname'] = $parts[1];
                $data['lname'] = $parts[2];
            }

            $data['teacher_code'] = $row['teacher_code'];
            $data['alias'] = $row['alias'];
            $data['subject'] = $row['subject'];
            $data['gender'] = $row['gender'];
            $data['phone'] = $row['phone'];
            $data['email'] = $row['email'];
            $data['id'] = $row['id'];
        }
        echo json_encode($data);
    }

    if ($_POST["action"] == 'delete') {
        $id = $_POST["id"];
        $object->query = "SELECT display_image , teacher_code FROM teacher_list WHERE id = '$id'";
        $result = $object->get_result();
        foreach ($result as $row) {
            $resultset[] = $row;
        }
        $object->query = "
		DELETE FROM teacher_list 
		WHERE id = '" . $id . "'
		";
        $object->execute();
        if (!empty($resultset)) {
            unlink('../uploads/images/faculty/' . $resultset[0]['display_image']);
            $object->query = "DROP TABLE " . $resultset[0]['teacher_code'];
            $object->execute();
        }
        echo '<div class="alert alert-success">teacher Deleted</div>';
    }
}
function upload_image()
{
    if (isset($_FILES["display_image"])) {
        $extension = explode('.', $_FILES['display_image']['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = '../uploads/images/faculty/' . $new_name;
        move_uploaded_file($_FILES['display_image']['tmp_name'], $destination);
        return $new_name;
    }
}
