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
    function get_classroom($course, $branch, $semester)
    {
        $this->query = "
				SELECT classroom FROM classroom_allotment where course_code = '" . $course . "' AND branch_code = '" . $branch . "' AND semester = '" . $semester . "'   
				ORDER BY course_code ASC
				";
        $result = $this->get_result();

        foreach ($result as $row) {
            return $row['classroom'];
        }
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
    function get_teacher_subject($subject)
    {
        $this->query = "
				SELECT teacher_code , name FROM teacher_list where subject = '" . $subject . "'   
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
    function get_subject_bycode($id)
    {
        $this->query = "
        SELECT name FROM branch where subject_code = '" . $id . "'    
        LIMIT 1
        ";

        // var_dump($this->query);
        $result = $this->get_result();

        foreach ($result as $value) {
            return $value;
        }
    }
    function get_teacher_bycode($id)
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
        $data = preg_replace('/[^\p{L}\p{N}]/u', '', $data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = str_replace(' ', '_', $data);
        return $data;
    }
    function cleanTable($data)
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
    function days()
    {
        // var_dump($limit);
        $days = array(
            '1' => 'monday',
            '2' => 'tuesday',
            '3' => 'wednesday',
            '4' => 'thursday',
            '5' => 'friday',
            '6' => 'saturday',
        );
        $html = '
		<select name="days" id="day_list" required>
			<option value="">Select weekday</option>
		';
        foreach ($days as $key => $values) {

            $html .= '<option value="' . $values . '">' . $values . '</option>';
        }
        $html .= '</select>';
        return $html;
    }



    function free_slot_table($day, $table)
    {
        $this->query = "select *  from $table where day='" . $day . "'";
        $result = $this->get_result();
        $html = '
		<select name="free_slot" id="free_slot" required>
			<option value="">Select slot</option>
		';
        foreach ($result as $values) {
            for ($x = 1; $x <= 6; $x++) {
                if ($values["period" . $x] == NULL) {
                    $html .= '<option value="' . "period" . $x . '">' . "period" . $x . '</option>';
                }
            }
        }

        $html .= '</select>';
        return $html;
    }
    // function free_teacher($day, $table)
    // {
    //     $this->query = "select *  from $table where day='" . $day . "'";
    //     $result = $this->get_result();
    //     $html = '
    // 	<select name="free_slot" id="free_slot" required>
    // 		<option value="">Select slot</option>
    // 	';
    //     foreach ($result as $values) {
    //         for ($x = 1; $x <= 6; $x++) {
    //             if ($values["period" . $x] == NULL) {
    //                 $html .= '<option value="' . "period" . $x . '">' . "period" . $x . '</option>';
    //             }
    //         }
    //     }

    //     $html .= '</select>';
    //     return $html;
    // }
    function free_teacher($day, $table)
    {
        $this->query = "select *  from $table where day='" . $day . "'";
        $result = $this->get_result();
        $teacher = array();
        if (!$result) {
            return;
        }
        foreach ($result as $values) {
            for ($x = 1; $x <= 6; $x++) {
                if ($values["period" . $x] == NULL) {
                    array_push($teacher, "period" . $x);
                }
            }
        }
        return $teacher;
    }
    function free_course_slot($day, $table)
    {
        $this->query = "select *  from $table where day='" . $day . "'";
        $result = $this->get_result();
        $course = array();
        if (!$result) {
            return;
        }
        foreach ($result as $values) {
            for ($x = 1; $x <= 6; $x++) {
                if ($values["period" . $x] == NULL) {
                    array_push($course, "period" . $x);
                }
            }
        }
        return $course;
    }
    function free_slot($day, $course, $branch, $semester, $teacher)
    {
        $generatedTable = $this->cleanTable($course . $branch . $semester);
        $course = $this->free_course_slot($day, $generatedTable);
        $teacher =  $this->free_teacher($day, $teacher);
        if ($course == '' or $teacher == '') {
            return;
        }
        $freeSlot = array_intersect($course, $teacher);
        $html = '
		<select name="free_slot" id="free_slot" required>
			<option value="">Select slot</option>
		';
        foreach ($freeSlot as $slot) {

            $html .= '<option value="' . $slot . '">' . $slot . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

    function no_timetable_subject()
    {
        $this->query = "select *  from subject where status='no' ORDER BY name ASC";
        $result = $this->get_result();
        $html = '
		<select name="subject" id="no_timetable_subject" required>
			<option value="">Select subject</option>
		';
        foreach ($result as $values) {
            $html .= '<option value="' . $values['subject_code'] . '">' . $values['name'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

    function get_subject()
    {
        $this->query = "select *  from subject ORDER BY name ASC";
        $result = $this->get_result();
        $html = '
		<select name="subject" id="no_timetable_subject" required>
			<option value="">Select subject</option>
		';
        foreach ($result as $values) {
            $html .= '<option value="' . $values['subject_code'] . '">' . $values['name'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }
    function get_table_weekends_list($table_name,  $day)
    {
        $this->query = "
		SELECT * FROM $table_name where day = '" . $day . "'
		";
        $result = $this->get_result();
        $table = '';
        foreach ($result as $row) {
            $table .= '<tr>';
            $table .= '<td>' . $row['day'] . '</td>';
            $table .= '<td>' . $row['period1'] . '</td>';
            $table .= '<td>' . $row['period2'] . '</td>';
            $table .= '<td>' . $row['period3'] . '</td>';
            $table .= '<td>' . $row['period4'] . '</td>';
            $table .= '<td>' . $row['period5'] . '</td>';
            $table .= '<td>' . $row['period6'] . '</td>';
            $table .= '</td>';
        }
        return $table;
    }




    // while ($row = $res->fetch()) {

    // }
    // echo $free_slot;
}
