<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



class Db_object
{



    /**
     * Check to see if this String matches the object's attribute or property
     * @param String $the_attribute of a property this object should have.
     * @return Boolean - whether or not this User object has a property that matches $the_attribute string.
     */
    private function has_the_attribute($the_attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }


    /**
     * Instantiates User instance out of the passed in query associated array.
     * @param AssociativeArray $row is a returned record, a array of the row.
     * @return \self $the_object is a User object.
     */
    public static function instantiation($row)
    {
        $the_object = new self();

        foreach ($row as $the_attribute => $value) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }

        return $the_object;
    }


    /**
     * This method will return query results.
     * @global Database $database
     * @param String $sql
     * @return \User the result in a User object.
     */
    public static function find_this_query($sql)
    {
        // execute any query and return it to us.
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();
        while($row = mysqli_fetch_assoc($result_set)) {
            $the_object_array[] = static::instantiation($row);
        }
        return $the_object_array;
    }


    /**
     * Retrieve a user by their id.
     * @global Database $database
     * @param Integer $id, a user's id.
     * @return User object of the user.
     */
    public static function find_by_id($id)
    {
        global $database;
        $sql = "SELECT * FROM " . static::$db_table
            . " WHERE id = {$database->escape_string($id)} LIMIT 1";

        $result_set = static::find_this_query($sql);
        //var_dump($result_sets);

        return !empty($result_set) ? array_shift($result_set) : new User();
    }


    public static function find_all()
    {
         return static::find_this_query("SELECT * FROM " . static::$db_table);
    }

}