<?php

/**
 * Description of users
 *
 * @author Javed Gardezi
 * 
 */

require_once("initialize.php");


class Users {
    
    protected static $db_fields = array('uid', 'name', 'mail', 'created');
    //private members
    private $uid;
    private $name;
    private $mail;
    private $created;
    
    function __construct() {
        
    }
        
    /*
     * Getter
     */
    public function getUid() {
        return $this->uid;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getMail() {
        return $this->mail;
    }
    
    public function getCreated() {
        return $this->created;
    }
    
    /*
     * Setter
     */
    public function setUid($uid) {
        return $this->uid = $uid;
    }
    
    public function setName($name) {
        return $this->name = $name;
    }
    
    public function setMail($mail) {
        return $this->mail = $mail;
    }
    
    public function setCreated($created) {
        return $this->created = $created;
    }
    
    /*
     * Fetch the updated user records from research gateway database
     */
    public function get_all_rgw() {
        
        $object_array = array();
        
        //change the database to RGW
        db_set_active('rgw');
        
         //query the database 
        $sql = "SELECT DISTINCT u.uid, u.name, u.mail, u.created FROM ur_users u 
            JOIN ur_node n ON (n.uid = u.uid) 
            JOIN ur_content_field_faculty f ON (n.nid = f.nid AND n.vid=f.vid) 
            WHERE f.field_faculty_nid=57893 AND SUBSTRING(u.name,1,1)='z' ";
        
        //execute the query using drupal 7 database functions
        $result = db_query($sql);
        
        foreach ($result as $record) {
            $object_array[] = $record;
            //krumo($record);
        }
        return $object_array;
    }
    
    /*
     * Merge the updated data to profiles database - table users
     * from the get_all_rgw() function
     */
    public function merge_data() {

        $primaryKey = 'uid';
        //Get the user records
        //$users = new Users();
        $result = $this->get_all_rgw();

        db_set_active('profiles');
        //Perform merge query;
        foreach ($result as $attribute => $value) {
            $key = array();
            $fields = array();
                      
            $len = count((array)$value);
            $key = array_slice((array)$value, -$len, 1);
            $fields = array_slice((array) $value, 1);
            
            /*echo "<pre>";
                print_r($key);
                print_r($fields);
            echo "</pre>"; */
           
            try {
                $query = db_merge('users')
                        ->key($key)
                        ->fields($fields)
                        ->execute();
            } catch (Exception $e) {
                print("Merge query error: " . $e . "<br />");
                // Log the exception to watchdog.
                watchdog_exception('Merge Query', $e);
            }
            //die();
        }
    }
    
}

?>
