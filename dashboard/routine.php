<?php
class routine
{
    public $base_url = 'http://localhost/routine management/';
    public $connect;
    public $query;
    public $statement;
    public $pdo;
    function routine()
    {
        $this->connect = new PDO("mysql:host=localhost;dbname=routine", "root", "");
        session_start();
    }
    function execute($data = null)
    {
        $this->statement = $this->connect->prepare($this->query);
        if ($data) {
            $this->statement->execute($data);
        } else {
            $this->statement->execute();
        }
    }

    function row_count()
    {
        return $this->statement->rowCount();
    }
    function statement_result()
    {
        return $this->statement->fetchAll();
    }
    function get_result()
    {

        return $this->connect->query($this->query, PDO::FETCH_ASSOC);
    }
    function is_login()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        }
        return false;
    }
    function is_admin()
    {
        if (isset($_SESSION['user_type'])) {
            if ($_SESSION["user_type"] == 'Master') {
                return true;
            }
            return false;
        }
        return false;
    }
    function is_teacher()
    {
        if (isset($_SESSION['user_type'])) {
            if ($_SESSION["user_type"] == 'Waiter') {
                return true;
            }
            return false;
        }
        return false;
    }
    function freeAllotment()
    {
    }
    function onLeave()
    {
    }
    function get_course()
    {
        $this->query = "
				SELECT course_name , course_code FROM course   
				ORDER BY course_name ASC
				";
        $result = $this->get_result();
        $html = '
		<select name="course" id="course_select" required>
			<option value="" readonly>Select Course</option>
		';
        foreach ($result as $values) {
            $html .= '<option value="' . $values['course_code'] . '">' . $values['course_name'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }
    function get_free_classroom()
    {
        $this->query = "
				SELECT classroom_code FROM classroom where status = 'free'   
				ORDER BY classroom_code ASC
				";
        $result = $this->get_result();
        $html = '
		<select name="classroom" id="classroom_select" required>
			<option value="" readonly>Select Classroom</option>
		';
        foreach ($result as $values) {
            $html .= '<option value="' . $values['classroom_code'] . '">' . $values['classroom_code'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }
    function get_teacher()
    {
        $this->query = "
				SELECT teacher_code , name FROM teacher_list   
				ORDER BY name ASC
				";
        $result = $this->get_result();
        $html = '
		<select name="teacher" id="teacher_select" required>
			<option value="" readonly>Select teacher</option>
		';
        foreach ($result as $values) {
            $html .= '<option value="' . $values['teacher_code'] . '">' . $values['name'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }
    function get_course_name($id)
    {
        $this->query = "
		SELECT course_name FROM course where  course_code = '" . $id . "' LIMIT 1
		";

        $result = $this->get_result();
        foreach ($result as $row) {
            return $row['course_name'];
        }
    }
    function get_branch_name_from_code($id)
    {
        $this->query = "
		SELECT branch FROM branch where  branch_code = '" . $id . "' LIMIT 1
		";

        $result = $this->get_result();
        foreach ($result as $row) {
            return $row['branch'];
        }
    }
    function get_course_duration($course)
    {
        $this->query = "
		SELECT course_duration FROM course where  course_code = '" . $course . "' LIMIT 1
		";

        $result = $this->get_result();
        foreach ($result as $row) {
            return $row['course_duration'];
        }
    }
    function get_branch_name($id)
    {
        $this->query = "
        SELECT branch , branch_code FROM branch where course = '" . $id . "'    
        ORDER BY branch ASC
        ";

        // var_dump($this->query);
        $result = $this->get_result();
        $html = '<select name="branch" id="branch_select" required>';
        $html .= '<option value="" readonly>Select branch</option>';
        foreach ($result as $values) {
            $html .= '<option value="' . $values['branch_code'] . '">' . $values['branch'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

    function clean_input($string)
    {
        $string = trim($string);
        $string = stripslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }
    function e($data)
    {
        $data = strip_tags(html_entity_decode($data));
        $data = preg_replace('/[^\p{L}\p{N}]/u', ' ', $data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function Is_set_up_done()
    {
        $this->query = "
		SELECT account_id FROM useraccounts";
        $this->execute();
        if ($this->row_count() > 0) {

            return true;
        } else {
            return false;
        }
    }
    function make_avatar($character)
    {
        $path = "../../images/" . time() . ".png";
        $image = imagecreate(200, 200);
        $red = rand(0, 255);
        $green = rand(0, 255);
        $blue = rand(0, 255);
        imagecolorallocate($image, 230, 230, 230);
        $textcolor = imagecolorallocate($image, $red, $green, $blue);
        imagettftext($image, 100, 0, 55, 150, $textcolor, dirname(__FILE__) . '/font/arial.ttf', $character);
        imagepng($image, $path);
        imagedestroy($image);
        return $path;
    }
    function semester_list($limit)
    {
        // var_dump($limit);
        $quantity_unit = array(
            '1' => 'Semester 1',
            '2' => 'Semester 2',
            '3' => 'Semester 3',
            '4' => 'Semester 4',
            '5' => 'Semester 5',
            '6' => 'Semester 6',
            '7' => 'Semester 7',
            '8' => 'Semester 8',

        );
        $html = '
		<select name="semester" id="semester_list" required>
			<option value="">Select Semester</option>
		';
        for ($i = 1; $i < $limit + 1; $i++) {

            $html .= '<option value="' . array_search($quantity_unit[$i], $quantity_unit) . '">' . $quantity_unit[$i] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }
}
