<?php

require_once("initialize.php");

/**
 * Base class for synchronization 
 *
 * @author Javed Gardezi
 */


class profiles {
    
    /*
     * Fetch updated user records from research gateway database
     */
    public function fetch_users_records() {
        
        //change the database to RGW
        db_set_active('rgw');
        
        //query the database 
        $sql = "SELECT DISTINCT u.uid, u.name, u.mail, u.created FROM ur_users u 
            JOIN ur_node n ON (n.uid = u.uid) 
            JOIN ur_content_field_faculty f ON (n.nid = f.nid AND n.vid=f.vid) 
            WHERE f.field_faculty_nid=57893 AND SUBSTRING(u.name,1,1)='z' ";
        
        //execute the query using drupal 7 database functions
        $result = db_query($sql);
        return $result;
    }
    
}

?>
