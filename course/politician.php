<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Completely unenrol a user from a course.
 *
 * Please note when unenrolling a user all of their grades are removed as well,
 * most ppl actually expect enrolments to be suspended only...
 *
 * @package    core_enrol
 * @copyright  2011 Petr skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
global $DB;
require('../config.php');
require_once("$CFG->dirroot/enrol/locallib.php");
require_once("$CFG->dirroot/enrol/renderer.php");
global $USER;
$idUser = $USER->id; // User id.

$courseid = filter_input(INPUT_GET, 'courseid');

$confirm = optional_param('confirm', false, PARAM_BOOL);
$course2 = optional_param('courseid', '', PARAM_TEXT);
//$filter  = optional_param('ifilter', 0, PARAM_INT);
//echo 'course '.$course2;
$user = $DB->get_record('user', array('id'=>$idUser), '*', MUST_EXIST);


// set up PAGE url first!
//$PAGE->set_url('/course/politician.php', array('ue'=>$ueid, 'ifilter'=>$filter));
//$PAGE->set_url('/course/politician.php', array('ue'=>$ueid, 'ifilter'=>$filter));
$PAGE->set_url('/course/politician.php', array('userid'=>$idUser,'courseid'=>$course2));
//$PAGE->set_url('/course/politician.php', array('id' => $course->id));

require_login($course2);


//$manager = new course_enrolment_manager($PAGE, $course, $filter);
//$table = new course_enrolment_users_table($manager, $PAGE);

$usersurl = new moodle_url('/course/view.php', array('id' => $course2));
//echo 'url: '.$usersurl;
//container
//$PAGE->set_pagelayout('admin');
navigation_node::override_active_url($usersurl);
//print_r($instance);
// If the unenrolment has been confirmed and the sesskey is valid unenrol the user.

if ($confirm && confirm_sesskey()) {
    //$plugin->unenrol_user($instance, $ue->userid);
    //echo 'courseid:'.$course2.'-id: '.$idUser;
    
    $sql = 'Select politician from modl_course where id='.$course2;
    $aux = $DB->get_record_sql($sql);
    if(empty($aux)){
        $aux2 = 0;
    }else{
        $aux2 = 1;
    }
    //echo $sql;
    $sql = 'select * from politicas_curso p
    WHERE p.courseid = '.$course2.' and p.userid = '.$idUser;
    //$politicas = $DB->get_records_sql($sql);
    //echo $sql;
    $flag = $DB->get_record_sql($sql);
    if(empty($flag)){
        $aux3 = 0;
    }else{
        $aux3 = 1;
    }
    echo 'aux: '.$aux2.' flag: '.$aux3;
    if($aux2 && !$aux3){
        $sql='insert into politicas_curso (courseid, userid,fechapolitica,politician) 
        VALUES('.$course2.','.$idUser.',DATE(\''.(new \DateTime())->format('Y-m-d H:i:s').'\'),1)';
        $DB->execute($sql);
        redirect($usersurl);
    }else{
        redirect($usersurl);
    }
    
}else{
    $sql = 'Select politician from modl_course where id='.$course2;
    $aux = $DB->get_record_sql($sql);
    //echo 'else1: '.$sql;
    if(empty($aux)){
        $aux2 = 0;
    }else{
        $aux2 = 1;
    }
    //echo $sql;
    $sql = 'select * from politicas_curso p
    WHERE p.courseid = '.$course2.' and p.userid = '.$idUser;
    //$politicas = $DB->get_records_sql($sql);
    //echo 'else2: '.$sql;
    $flag = $DB->get_record_sql($sql);
    if(empty($flag)){
        $aux3 = 0;
    }else{
        $aux3 = 1;
    }
    //echo '>>>>aux: '.$aux2.' flag: '.$aux3;
    if($aux2 && $aux3){
        //echo 'FIN';
        redirect($usersurl);
    }
}

$sql='insert into politicas_curso (courseid, userid,fechapolitica,politician) 
        VALUES('.$course->id.','.$idUser.',DATE(\''.(new \DateTime())->format('Y-m-d H:i:s').'\'),1)';
//echo $sql;
//$usersurl=$usersurl.'qwerty';
$yesurl = new moodle_url($PAGE->url, array('confirm'=>'1', 'sesskey'=>sesskey(),'courseid'=>$course2,'userid'=>$idUser));
//$yesurl = new moodle_url($usersurl, array('confirm'=>1, 'sesskey'=>sesskey()));
$message = 'La siguiente informaci&oacute;n es exclusiva del Banco, usted debe aceptar las pol&iacute;ticas para su uso.';
$fullname = fullname($user);
$title = 'Pol&iacute;tica curso';

$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->navbar->add($title);
$PAGE->navbar->add($fullname);
print_r($OUTPUT);
foreach ($OUTPUT as $asd){
    echo $asd;
}
echo $OUTPUT->header();
echo $OUTPUT->heading($fullname);
echo $OUTPUT->confirm($message, $yesurl, $usersurl);
echo $OUTPUT->footer();
