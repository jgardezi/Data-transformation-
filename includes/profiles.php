<?php

require_once("initialize.php");

/**
 * Base class for synchronization 
 *
 * @author Javed Gardezi
 */
class Profiles {
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
    
    /*
     * merge_data() function updates the 
     */
    public function merge_data() {

        $primaryKey = 'uid';
        //Get the user records
        $users = new Users();
        $result = $users->get_all();

        //Perform merge query;
        foreach ($result as $attribute => $value) {
            $key = array();
            $fields = array();
            
            /*$count = 0;

            foreach ($value as $subAttribute => $v) {
                if ($subAttribute == $primaryKey) {
                    if ($count == 0) {
                        $key = array(
                            $subAttribute => $v,
                        );
                    }
                }
                $count++;
            }*/
            $len = count((array)$value);
            $key = array_slice((array)$value, -$len, 1);
            $fields = array_slice((array) $value, 1);
            try {

                $query = db_merge('users')
                        ->key($key)
                        ->fields($fields)
                        ->execute();
            } catch (Exception $e) {
                print("Merge query error: " + $e . "<br />");
                // Log the exception to watchdog.
                watchdog_exception('Merge Query', $e);
            }
        }
    }
    
    

}

?>
