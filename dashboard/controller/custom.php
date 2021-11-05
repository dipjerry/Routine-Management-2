<?php
//product_action.php
include('../routine.php');
$object = new routine();
if (isset($_POST["action"])) {
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
    if ($_POST["action"] == 'subjectTeacher') {

        $teacher = $object->get_teacher_subject($_POST["subject"]);
        $output = array(
            'teacher'        =>    $teacher,
        );
        echo json_encode($output);
    }
    if ($_POST["action"] == 'freeSlot') {

        $day = $object->clean_input($_POST['day']);
        $teacher = $object->clean_input($_POST['teacher']);
        $course = $object->clean_input($_POST['course']);
        $branch = $object->clean_input($_POST['branch']);
        $semester = $object->clean_input($_POST['semester']);
        $teacher = $object->clean_input($_POST['teacher']);
        $error = '';
        $slot = $object->free_slot($day, $course, $branch, $semester, $teacher);
        if ($slot == '') {
            $error = "table not generated yet";
        }
        $output = array(
            'slot'        =>    $slot,
            'error'        =>    $error,
        );
        echo json_encode($output);
    }
}
