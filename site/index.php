<?php


// The number of lines in front of config file determine the // hierarchy of files. 
require_once("../config.php");

$PAGE->set_context(get_system_context());
$PAGE->set_pagelayout('custom');
$PAGE->set_title("Terms of Service");
$PAGE->set_heading("Terms of Service");
$PAGE->set_url($CFG->wwwroot.'/site/index.php');


echo $OUTPUT->header();


echo "Terms of Service go here.";


echo $OUTPUT->footer();
?>