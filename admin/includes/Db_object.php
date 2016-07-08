<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



class Db_object
{

    /*Custom errors*/
    public $errors = array();
    /*Common upload errors*/
    public $upload_errors = array(
        UPLOAD_ERR_OK           => "There is no error",
        UPLOAD_ERR_INI_SIZE     => "The uploaded file exceeds the upload_max_filesize directive.",
        UPLOAD_ERR_FORM_SIZE    => 'The upload file exceeds the MAX_FILE_SIZE directive',
        UPLOAD_ERR_PARTIAL      => 'The uploaded file was only partially uploaded',
        UPLOAD_ERR_NO_FILE      => 'No file was uploaded.',
        UPLOAD_ERR_NO_TMP_DIR   => 'Missing a temporary folder.',
        UPLOAD_ERR_CANT_WRITE   => 'Failed to write file to disk.',
        UPLOAD_ERR_EXTENSION    => 'A PHP extension stopped the file upload.'
    );

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

    protected function properties()
    {

        $properties = array();
        foreach (static::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }

        return $properties;
    }



    protected function clean_properties()
    {
        global $database;

        $clean_properties = array();

        foreach ($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }

        return $clean_properties;
    }





    /**
     * Instantiates User instance out of the passed in query associated array.
     * @param AssociativeArray $row is a returned record, a array of the row.
     * @return \self $the_object is a User object.
     */
    public static function instantiation($row)
    {

        $calling_class = get_called_class();
        $the_object = new $calling_class;

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
    public static function find_by_query($sql)
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

    
    public static function find_all()
    {
         return static::find_by_query("SELECT * FROM " . static::$db_table);
    }

    
    


    public function update()
    {
        global $database;

        $properties = $this->clean_properties();
        $properties_pairs = array();

        foreach ($properties as $key => $value) {
            $properties_pairs[$key] = "{$key} = '{$value}'";
        }

        $sql = "UPDATE " . self::$db_table. " SET "
                . implode(",", $properties_pairs)
                . " WHERE id = {$database->escape_string($this->id)}";

        $database->query($sql);

        return (mysqli_affected_rows($database->getConnection()) == 1) ? true : false;
    }
}
