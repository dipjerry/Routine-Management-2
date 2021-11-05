<?php
//product_action.php
include('../routine.php');
$object = new routine();
if (isset($_POST["action"])) {
    if ($_POST["action"] == 'fetch') {

        $order_column = array('subject', 'message', 'link', 'image', 'time');
        $output = array();
        $main_query = "SELECT * FROM announcement";
        $search_query = '';
        if (isset($_POST["search"]["value"])) {
            $search_query .= ' WHERE subject LIKE "%' . $_POST["search"]["value"] . '%" ';
            $search_query .= 'OR message LIKE "%' . $_POST["search"]["value"] . '%" ';
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

        $result = $object->get_result();
        $object->query = $main_query;
        $object->execute();
        $total_rows = $object->row_count();
        $data = array();
        foreach ($result as $row) {
            $sub_array = array();
            $sub_array[] = $row["subject"] . '<br>' . $row["time"];
            $sub_array[] = $row["message"];
            $sub_array[] = $row["link"];
            $sub_array[] = '<img src="./uploads/images/announcement/' . $row["image"] . '" class=" img-thumbnail" width="100%" height="100" />';
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

        $display_image = '';
        if ($_FILES["image"]["name"] != '') {
            $display_image = upload_image();
        } else {
            $display_image = NULL;
        }
        $link = '';
        if ($_POST["link"] != '') {
            $link = $object->clean_input($_POST["link"]);
        } else {
            $link = NULL;
        }

        $data = array(
            ':subject'              => $object->e($_POST["subject"]),
            ':message'             =>    $object->e($_POST["message"]),
            ':link'            =>    $link,
            ':display_image'     =>    $display_image,
        );
        $object->query = "
			INSERT INTO announcement (subject, message ,link, image)
			VALUES (:subject, :message, :link, :display_image)
			";
        $object->execute($data);
        $success = '<div class="alert alert-success">Teacher Added</div>';

        $output = array(
            'error'        =>    $error,
            'success'    =>    $success
        );
        echo json_encode($output);
    }
    if ($_POST["action"] == 'fetch_single') {
        $object->query = "
		SELECT * FROM product_table 
		WHERE product_id = '" . $_POST["product_id"] . "'
		";
        $result = $object->get_result();
        $data = array();
        foreach ($result as $row) {
            $data['category_name'] = $row['category_name'];
            $data['product_name'] = $row['name'];
            $data['product_price'] = $row['price'];
        }
        echo json_encode($data);
    }
    if ($_POST["action"] == 'Edit') {
        $error = '';
        $success = '';
        $data = array(
            ':category_name'    =>    $_POST["category_name"],
            ':product_name'        =>    $_POST["product_name"],
            ':product_id'        =>    $_POST['hidden_id']
        );
        $object->query = "
		SELECT * FROM product_table 
		WHERE category_name = :category_name 
		AND name = :product_name
		AND product_id != :product_id
		";
        $object->execute($data);
        if ($object->row_count() > 0) {
            $error = '<div class="alert alert-danger">Product Already Exists</div>';
        } else {
            $data = array(
                ':category_name'    =>    $_POST["category_name"],
                ':product_name'        =>    $object->clean_input($_POST["product_name"]),
                ':product_price'    =>    $object->clean_input($_POST["product_price"])
            );
            $object->query = "
			UPDATE product_table 
			SET category_name = :category_name, 
			product_name = :product_name, 
			product_price = :product_price   
			WHERE product_id = '" . $_POST['hidden_id'] . "'
			";
            $object->execute($data);
            $success = '<div class="alert alert-success">Product Updated</div>';
        }
        $output = array(
            'error'        =>    $error,
            'success'    =>    $success
        );
        echo json_encode($output);
    }

    if ($_POST["action"] == 'delete') {
        $id = $_POST["id"];
        $object->query = "SELECT * FROM announcement WHERE id = '$id'";
        $result = $object->get_result();
        foreach ($result as $row) {
            $resultset[] = $row;
        }
        $object->query = "
		DELETE FROM announcement 
		WHERE id = '" . $id . "'
		";
        $object->execute();
        if (!empty($resultset)) {
            unlink('../uploads/images/announcement/' . $resultset[0]['image']);
        }
        echo '<div class="alert alert-success">Product Deleted</div>';
    }
}
function upload_image()
{
    if (isset($_FILES["image"])) {
        $extension = explode('.', $_FILES['image']['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = '../uploads/images/announcement/' . $new_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $destination);
        return $new_name;
    }
}
