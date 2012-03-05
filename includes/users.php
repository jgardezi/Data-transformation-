<?php

/**
 * Description of users
 *
 * @author Javed Gardezi
 * 
 */

require_once("initialize.php");


class Users {
    
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
    
    public function find_all() {
        
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
    
    /*private static function instantiate($record) {
        // Could check that $record exists and is an array
        $object = new self;
        // Simple, long-form approach:
        // $object->id 				= $record['id'];
        // $object->username 	= $record['username'];
        // $object->password 	= $record['password'];
        // $object->first_name = $record['first_name'];
        // $object->last_name 	= $record['last_name'];
        // More dynamic, short-form approach:
        foreach ($record as $attribute => $value) {
            //krumo($attribute);
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }
    
    private function has_attribute($attribute) {
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $this->attributes());
    }*/
    
}

?>
