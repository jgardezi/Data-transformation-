<?php
require_once("../includes/initialize.php");

//echo "<p>".getcwd()."</p>";
//echo "<p>".LIB_PATH."</p>";

/*
$sql = "SELECT DISTINCT u.uid, u.name, u.mail, u.created FROM ur_users u JOIN ur_node n ON (n.uid = u.uid) JOIN ur_content_field_faculty f ON (n.nid = f.nid AND n.vid=f.vid) WHERE f.field_faculty_nid=57893 AND SUBSTRING(u.name,1,1)='z' ";

//print($sql);
db_set_active('rgw');
*/

$profiles = new Profiles();

$profiles->merge_data();

echo ("<p>Phase 1 done sucessfully!</p>"); 






 
  