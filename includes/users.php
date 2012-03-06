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
    
    public function get_all() {
        
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
        db_set_active('default');
        foreach ($result as $record) {
            $object_array[] = $record;
            //krumo($record);
        }
        return $object_array;
    }
    
    private static function instantiate($record) {
        // Could check that $record exists and is an array
        $object = new self;
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
    }
    
    protected function attributes() {
        // return an array of attribute names and their values
        $attributes = array();
        foreach (self::$db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }
    
}

?>
